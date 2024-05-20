<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
        }

        #footer2 {
            display: flex;
            justify-content: space-between;
        }

        p {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .bodycenter {
            text-align: center;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .bodyleft {
            text-align: left;
            margin-top: 0px;
            margin-bottom: 0px;
            padding: 0px;
            font-size: 16px
        }

        .header {
            text-align: center;
            font-weight: 600;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .content {
            margin-top: 15px;
            /* Content styling */
        }
    </style>
</head>

<body>
    <div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 85%; vertical-align: top; padding-right: 10px;">
                    <p style="margin-bottom: 0px; text-align: right;">Serial No. :</p>
                </td>
                <td style="width: 15%; vertical-align: top; padding-right: 10px;">
                    <p style="margin-bottom: 0px; text-align: left;">{{ $pengajuan->noserial_surat }}</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="header">
        <h3 style="margin-top: 170px; margin-bottom: 0px;">CERTIFICATE OF CONFORMITY</h3>
    </div>
    <div class="bodycenter">
        <table style="width: 100%;">
            <tr>
                <td style="width: 20%"></td>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <!-- Left column content -->
                    <p>Number</p>
                    <p>Commodity</p>
                </td>
                <td style="width: 40%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->no_surat }}</p>
                    <p>: {{ $pengajuan->commodity_surat }}</p>
                </td>
                <td style="width: 20%"></td>
            </tr>
        </table>
    </div>
    <div class="bodyleft">
        <p style="margin-top: 12px">KAN ACCREDITED LABORATORY No : {{ $sertification->no_lab }}</p>
        <p style="margin-bottom: 12px">The undersigned certify that samples submitted for testing by</p>
    </div>
    <div class="bodyleft">
        <table style="width: 100%;">
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>1. Sampler and Registration Number</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->regist_number }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>2. Date of sampling</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    @php
                        setlocale(LC_TIME, 'id_ID.utf8');
                        $datee = strftime('%e %B %Y', strtotime($pengajuan->date));
                    @endphp
                    <p>: {{ $datee }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>3. Sealing mark*)</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: " {{ $pengajuan->sealing_mark }} "</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>4. Report of sampling Taken from</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->report_sealing }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>5. Consignment of commodity</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->consignment_commodity }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>6. Identification of consignm</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p style="font-weight: 600">: {{ $pengajuan->identification }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>7. Exporting Company</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p style="font-weight: 600">: {{ $pengajuan->exporting_comp }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>8. Address of company</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->address }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>9. Registration number</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->regist_number }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>10. Type of packing</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->type_packing }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>11. Quantity of packages</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->qty_package }} Bags</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>12. Weight / Volume</p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->weight }} Kgs Gross <br>
                        : {{ $pengajuan->volume }} Kgs Nett</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="bodyleft">
        <p style="font-size: 15px">have been tested, the result confirm to SNI or other standars reference SNI.
            {{ $pengajuan->no_sni }} for Grade {{ $pengajuan->grade }}</p>
    </div>
    <div class="footer">
        <table style="width: 100%; margin-top: 5px">
            <tr>
                <td style="width: 60%; vertical-align: top; padding-right: 10px;">
                </td>
                <td style="width: 40%; vertical-align: top; padding-left: 10px;">
                    @php
                        setlocale(LC_TIME, 'id_ID.utf8');
                        $dateee = strftime('%e %B %Y', strtotime($pengajuan->created_at));
                    @endphp
                    <p>Bandar Lampung, {{ $dateee }}</p>
                    <p style="margin-top: 12px; font-size: 15px">HEAD OF THE INDUSTRY</p>
                    <p style="font-size: 15px">AND TRADE DEPARTEMENT</p>
                    <p style="font-size: 15px">OF PROVINSI LAMPUNG</p>
                    <p style="margin-top: 80px; text-decoration: underline;">{{ $sertification->kepala_dinas }}</p>
                    <p>NIP. {{ $sertification->nip }}</p>
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 3px">
            <tr>
                <td style="width: 60%; text-align:left;">*) if avaible
                </td>
                <td style="width: 40%; text-align:right;">Page: 1 of 2  
                </td>
            </tr>
        </table>
        
    </div>
</body>

</html>
