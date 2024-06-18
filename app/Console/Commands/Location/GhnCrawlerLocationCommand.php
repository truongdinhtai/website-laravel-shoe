<?php

namespace App\Console\Commands\Location;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Service\Transport\GhnCoreService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GhnCrawlerLocationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:ghn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Location GHN';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("--------------- INIT ---------------");
//        $provinces = $this->getProvince();
//        foreach ($provinces->data ?? [] as $item) {
//            $this->warn("------- name: ". $item->ProvinceName);
//            $provinceDb = Province::where('slug', Str::slug($item->ProvinceName))->first();
//            if ($provinceDb) {
//                $ghn = [
//                    'ghn_province_id' => $item->ProvinceID,
//                    'ghn_code' => $item->Code,
//                    'ghn_country_id' => $item->CountryID
//                ];
//                $provinceDb->ghn = json_encode($ghn);
//                $provinceDb->save();
//                $this->info("------- ------ MAP: name: ". $item->ProvinceName);
//            }
//        }

//        $this->processSyncProvince();
        $this->processSyncWards();

    }

    protected function processSyncWards()
    {
        DB::table('districts')->orderBy('id')->chunk(100, function($districts)
        {
            foreach ($districts as $district) {
                $ghnInfo = json_decode($district->ghn) ?? [];
                if(isset($ghnInfo->ghn_district_id)) {
                    $wardsResponse = $this->getWard([
                        'district_id' => $ghnInfo->ghn_district_id
                    ]);

                    $wardsData = $wardsResponse->data ?? [];
                    foreach ($wardsData as $item) {
                        $this->warn("------- Ward name: " . $item->WardName);
                        if ($item->WardName) {
                            $wardDB = Ward::where('slug', Str::slug($item->WardName))->first();
                            if ($wardDB) {
                                $ghn             = [
                                    'ghn_district_id' => $item->DistrictID,
                                    'ghn_code'        => $item->WardCode ?? null
                                ];
                                $wardDB->ghn = json_encode($ghn);
                                $wardDB->save();
                                $this->info("------- ------ MAP: Ward name: " . $item->WardName);
                            }else {
                                $nameV2 = str_replace(['xa-','thi-tran-','phuong-'],'',Str::slug($item->WardName));
                                $this->info("------- ------ QUERY -------: " . $nameV2);

                                $wardDB = Ward::where('slug', Str::slug($nameV2))->first();
                                if ($wardDB) {
                                    $ghn             = [
                                        'ghn_district_id' => $item->DistrictID,
                                        'ghn_code'        => $item->WardCode ?? null
                                    ];
                                    $wardDB->ghn = json_encode($ghn);
                                    $wardDB->save();
                                    $this->info("------- ------ MAP: Ward name: " . $item->WardName);
                                }
                            }
                        }
                    }
                }
            }
        });
    }

    protected function processSyncProvince()
    {
        $provinces = Province::all();
        foreach ($provinces as $province) {
            $this->warn("------- City name: " . $province->name);
            $ghnInfo = json_decode($province->ghn) ?? [];
            dump($ghnInfo);
            $districtsResponse = $this->getDistrict([
                'province_id' => $ghnInfo->ghn_province_id
            ]);

            $districts = $districtsResponse->data ?? [];
            foreach ($districts as $item) {
                $this->warn("------- District name: " . $item->DistrictName);
                $districtDB = District::where('slug', Str::slug($item->DistrictName))->first();
                if ($districtDB) {
                    $ghn             = [
                        'ghn_province_id' => $item->ProvinceID,
                        'ghn_district_id' => $item->DistrictID,
                        'ghn_code'        => $item->Code ?? null
                    ];
                    $districtDB->ghn = json_encode($ghn);
                    $districtDB->save();
                    $this->info("------- ------ MAP: District name: " . $item->DistrictName);
                } else {
                    $nameV2 = str_replace(['quan-','huyen-','thanh-pho-'],'',Str::slug($item->DistrictName));
                    $this->info("------- ------ QUERY -------: " . $nameV2);
                    $districtDB = District::where('slug', Str::slug($nameV2))->first();
                    if ($districtDB) {
                        $ghn             = [
                            'ghn_province_id' => $item->ProvinceID,
                            'ghn_district_id' => $item->DistrictID,
                            'ghn_code'        => $item->Code ?? null
                        ];
                        $districtDB->ghn = json_encode($ghn);
                        $districtDB->save();
                        $this->info("------- ------ MAP: District name: " . $item->DistrictName);
                    }
                }
            }
        }
    }

    protected function getProvince()
    {
        try {
            $response = GhnCoreService::getClient()->request('GET', "shiip/public-api/master-data/province");
            return json_decode($response->getBody());
        } catch (\Exception $exception) {
            Log::error("-------------- " . json_encode($exception->getMessage()));
        }
    }

    protected function getDistrict($data)
    {
        try {
            $response = GhnCoreService::getClient()->request('GET', "shiip/public-api/master-data/district", [
                'json' => $data
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $exception) {
            Log::error("-------------- " . json_encode($exception->getMessage()));
        }
    }

    protected function getWard($data)
    {
        try {
            $response = GhnCoreService::getClient()->request('POST', "shiip/public-api/master-data/ward", [
                'json' => $data
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $exception) {
            Log::error("-------------- " . json_encode($exception->getMessage()));
        }
    }
}
