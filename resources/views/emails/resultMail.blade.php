<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            tr:nth-child(even) {background-color: #f2f2f2;}
        </style>
    </head>
    <body>
    <div class="order-body">
            <div class="order-mail">
                <div class="logo" style="text-align: center">
                    <img src="http://revotica.hu/sites/default/files/logo_0.jpg" class="img-fluid my-6" alt="Revotica.hu">
                </div>
                <div class="info" style="text-align: center">
                    <h1 style="text-align: center">Értékelő információ</h1>
                    <table style="border: 1px solid #dadada; margin: auto;">
                        <col width="250px" />
                        <col width="250px" />
                        <tr>
                            <td style="padding:10px">
                                Értékelő vevőkódja:
                            </td>
                            <td style="padding:10px">
                                {{$szallitolevelszam->vevokod}}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px">
                                Értékelő szállítólevélszáma:
                            </td>
                            <td style="padding:10px">
                                {{$szallitolevelszam->szallitolevel }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px">
                                Értékelési űrlap azonosító :
                            </td>
                            <td style="padding:10px">
                                {{ $szallitolevelszam->published_questionnaire_id }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px">
                                Értékelés átlaga :
                            </td>
                            <td style="padding:10px">
                                {{ round( $result, 2, PHP_ROUND_HALF_UP) }}
                            </td>
                        </tr>
                    </table>
                </div>
                <h1 style="text-align: center">Eredmény</h1>
                <table style="border: 1px solid #dadada; margin: auto;">
                    <col width="500px" />
                    <col width="500px" />
                    <th>
                        Kérdés
                    </th>
                    <th>
                        Válasz
                    </th>
                    @foreach($answers as $page)
                        @foreach($page as $answer)
                            <tr>
                                <td style="padding: 10px">
                                    {{$answer['question']}}
                                </td>
                                <td style="padding: 10px">
                                    @if($answer['answer_type'] == 'decide')
                                        @if($answer['answer'] == 1)
                                            Igen
                                        @elseif($answer['answer'] == 1)
                                            Nem
                                        @endif
                                    @elseif($answer['answer_type'] == 'rating')
                                        {{ $answer['answer'] }}/5
                                    @else
                                        {{ $answer['answer'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
    </div>
    </body>
</html>