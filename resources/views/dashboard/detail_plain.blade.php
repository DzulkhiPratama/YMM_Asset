<!--  -->
@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $assets[0]->asset_name; ?></h1>

</div>
<div>

    <table width="307" style="border-style: none; width: 307px; height: 220px;">
        <tbody>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;">
                    <h3><strong>PIC</strong></h3>
                </td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;">
                    <h4><strong>Asset ID</strong></h4>
                </td>
            </tr>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;"><?= $assets[0]->User->name; ?></td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;"><?= $assets[0]->asset_id; ?></td>
            </tr>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;"></td>
            </tr>
            <tr style="height: 0px;">
                <td style="border-style: none; width: 93px; height: 0px;"></td>
                <td style="border-style: none; width: 93px; height: 0px;"></td>
                <td style="border-style: none; width: 121px; height: 0px;"></td>
            </tr>
            <tr style="height: 20px;">
                <td colspan="2" style="border-style: none; width: 186px; height: 20px;">
                    <h4><strong>Current&nbsp; &nbsp; &nbsp; &nbsp; </strong><strong>Status</strong></h4>
                </td>
                <td style="border-style: none; width: 121px; height: 20px;">
                    <h4><strong>Asset Type</strong></h4>
                </td>
            </tr>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;"><?= $assets[0]->asset_status->asset_status_name; ?></td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;"><?= $assets[0]->asset_types->asset_type_name; ?></td>
            </tr>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;"></td>
            </tr>
            <tr style="height: 0px;">
                <td style="border-style: none; width: 93px; height: 0px;"></td>
                <td style="border-style: none; width: 93px; height: 0px;"></td>
                <td style="border-style: none; width: 121px; height: 0px;"></td>
            </tr>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;">
                    <h4><strong>Asset Price</strong></h4>
                </td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;">
                    <h4><strong>Asset Location</strong></h4>
                </td>
            </tr>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;"><?= $assets[0]->asset_price; ?></td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;"><?= $assets[0]->location->asset_location_desc; ?></td>
            </tr>
            <tr style="height: 20px;">
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 93px; height: 20px;"></td>
                <td style="border-style: none; width: 121px; height: 20px;"></td>
            </tr>
            <tr style="height: 0px;">
                <td style="border-style: none; width: 93px; height: 0px;"></td>
                <td style="border-style: none; width: 93px; height: 0px;"></td>
                <td style="border-style: none; width: 121px; height: 0px;"></td>
            </tr>
            <tr style="height: 20px;">
                <td colspan="3" style="border-style: none; width: 307px; height: 20px;">
                    <h4><strong>Asset Log</strong></h4>
                </td>
            </tr>
            <tr style="height: 0px;">
                <td style="border-style: none; width: 307px; height: 20px;" colspan="3" rowspan="4"><?= $assets[0]->asset_log; ?></td>
            </tr>
            <tr style="height: 0px;"></tr>
            <tr style="height: 10px;"></tr>
            <tr style="height: 10px;"></tr>
        </tbody>
    </table>


</div>
@endsection