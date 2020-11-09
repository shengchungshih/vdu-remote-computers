<?php


namespace App\Http\Services;


use App\Models\RdpIS\Computers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RdpGeneratingService
{
    /**
     * @param $computerId
     * @return mixed
     */
    public function getComputerIp($computerId)
    {
        return Computers::where('id', $computerId)->first()->pc_ip;
    }

    /**
     * @param $computerId
     * @return string
     */
    public function getRdpFileContent($computerId): string
    {
        $computerIp = $this->getComputerIp($computerId);

        return
        "full address:s:$computerIp
        prompt for credentials:i:0
        enablecredsspsupport:i:0
        authentication level:i:2
        gatewayhostname:s:rdp-gateway.vdu.lt
        gatewayusagemethod:i:1
        gatewaycredentialssource:i:0
        gatewayprofileusagemethod:i:1";
    }

    /**
     * @param $computerId
     * @return string returns the uploaded file full url address
     */
    public function getRdpFileFromServer($computerId): string
    {
        $tempName = Str::random();

        Storage::put("$tempName.rdp", $this->getRdpFileContent($computerId));

        return env("RDP_TEMP_FILE_URL_ROOT")."/$tempName.rdp";
    }
}
