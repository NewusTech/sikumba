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
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .content {
            margin-top: 15px;
            /* Content styling */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Memastikan border tabel nempel */
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
    <div class="bodyleft">
        <table style="width: 100%;">
            <tr>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <p>Number</p>
                </td>
                <td style="width: 80%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->no_surat }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <p>Commodity</p>
                </td>
                <td style="width: 80%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->commodity_surat }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <p>Sample desciption</p>
                </td>
                <td style="width: 80%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->sample_desc_surat }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <p>Code of Number</p>
                </td>
                <td style="width: 80%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->code_number_surat }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <p>Date of Received</p>
                </td>
                <td style="width: 80%; vertical-align: top; padding-left: 10px;">
                    @if ($pengajuan->received_surat)
                        @php
                            setlocale(LC_TIME, 'id_ID.utf8');
                            $date = strftime('%e %B %Y', strtotime($pengajuan->received_surat));
                        @endphp
                        <p>: {{ $date }}</p>
                    @else
                        <p>:</p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <p>Date of Testing</p>
                </td>
                <td style="width: 80%; vertical-align: top; padding-left: 10px;">
                    @if ($pengajuan->testing_surat)
                        @php
                            setlocale(LC_TIME, 'id_ID.utf8');
                            $datee = strftime('%e %B %Y', strtotime($pengajuan->testing_surat));
                        @endphp
                        <p>: {{ $datee }}</p>
                    @else
                        <p>:</p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <p>Test Desciption</p>
                </td>
                <td style="width: 80%; vertical-align: top; padding-left: 10px;">
                    <p>:</p>
                </td>
            </tr>

        </table>

        <table style="width: 100%; margin-top: 15px">
            <thead>
                <tr>
                    <th
                        style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Characteristic</p>
                    </th>
                    <th
                        style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Method</p>
                    </th>
                    <th
                        style="width: 13%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Unit</p>
                    </th>
                    <th
                        style="width: 13%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Test Result</p>
                    </th>
                    <th
                        style="width: 13%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Grade Limit</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($pengajuan->detail)
                    @foreach (json_decode($pengajuan->detail) as $detail)
                        <tr>
                            <td
                                style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail->characteristic }}</p>
                            </td>
                            <td
                                style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail->method }}</p>
                            </td>
                            <td
                                style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail->unit }}</p>
                            </td>
                            <td
                                style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail->test }}</p>
                            </td>
                            <td
                                style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail->grade }}</p>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td style="width: 30%;"></td>
                        <td style="width: 30%;"></td>
                        <td style="width: 30%;"></td>
                        <td style="width: 30%;"></td>
                        <td style="width: 30%;"></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="bodyleft" style="margin-top: 5px">
        <p>Note : Grade limit based on method Indonesia Nasional Standard Number : SNI {{ $sertification->no_sni }}</p>
    </div>
    <div class="footer">
        <table style="width: 100%; margin-top: 10px">
            <tr>
                <td style="width: 35%; vertical-align: top; padding-right: 10px; text-align:center">
                    <p style="margin-top: 70px;">The findings above are only based</p>
                    <p>Only samples taken and tested</p>
                    <p style="margin-top: 55px;">the certificate is valid withen</p>
                </td>
                <td style="width: 25%;">
                </td>
                <td style="width: 40%; vertical-align: top; padding-left: 10px; text-align:center">
                    @php
                        setlocale(LC_TIME, 'id_ID.utf8');
                        $dateee = strftime('%e %B %Y', strtotime($pengajuan->created_at));
                    @endphp
                    <p>Bandar Lampung, {{ $dateee }}</p>
                    <p style="margin-top: 30px; font-size: 15px">Sincerely yours</p>
                    <p style="font-size: 15px">Tehnical manager</p>
                    <p style="margin-top: 80px; text-decoration: underline;">{{ $sertification->technical_manager }}
                    </p>
                    <p>NIP. {{ $sertification->nip_manager }}</p>
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 3px">
            <tr>
                <td style="width: 30%; text-align:center; border: 1px solid; border-color: black;">
                    <span style="padding-top: 3px;padding-bottom: 3px; padding-left: 5px; padding-right: 5px;">
                        {{ $pengajuan->note_sertif }}
                    </span>
                </td>
                <td style="width: 70%; text-align:right;">Page: 2 of 2
                </td>
            </tr>
        </table>

        <hr>

    </div>

</body>

</html>
