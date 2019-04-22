<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 22.04.2019
 * Time: 4:42
 */
$this->params['pageID']="payments";

?>

<table class="table-title">
    <tr>
        <th class="title-name">Payments</th>
        <th class="tabs">
            <button class="tablinks active" onclick="year(event, '2019')" id="OpenTab">2019</button>
            <button class="tablinks" onclick="year(event, '2018')">2018</button>
            <button class="tablinks" onclick="year(event, '2017')">2017</button>
        </th>
        <th class="card">By: Card **3385
            <a data-fancybox data-src="#edit-paymant" href="javascript:;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="w6n5a" d="M793.494 68.512l-5.573 5.596-2.03-2.029 5.597-5.573zm1.316-2.252a.63.63 0 0 1 .19.49.748.748 0 0 1-.235.514l-1.003 1.003-2.029-2.029 1.003-1.003a.748.748 0 0 1 .513-.234.63.63 0 0 1 .49.19zm-9.097 6.131l1.896 1.896L785 75zM790 80c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10z"/><linearGradient id="w6n5b" x1="780" x2="800" y1="80" y2="60" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#6673b4"/><stop offset="1" stop-color="#9eaeff"/></linearGradient></defs><g><g transform="translate(-780 -60)"><use fill="url(#w6n5b)" xlink:href="#w6n5a"/></g></g></svg>
            </a>
            <!-- add payment -->
            <!-- <a data-fancybox data-src="#add-payment" href="javascript:;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10ZM9.27955 5.36273C9.27996 4.96348 9.60044 4.64299 9.9997 4.64259C10.399 4.64218 10.7188 4.96202 10.7184 5.36128L10.7144 9.27412L14.6197 9.2777C15.019 9.27729 15.3388 9.59713 15.3384 9.99638C15.342 10.196 15.2627 10.3731 15.1307 10.5051C15.0025 10.6333 14.8179 10.7126 14.622 10.7128L10.7092 10.7167L10.7052 14.6296C10.7086 15.0251 10.4482 15.3455 9.98884 15.346C9.58959 15.3464 9.26975 15.0265 9.27016 14.6273L9.27412 10.7144L5.36128 10.7184C4.96202 10.7188 4.64218 10.399 4.64259 9.9997C4.64299 9.60044 4.96348 9.27996 5.36273 9.27955L9.27558 9.27558L9.27955 5.36273Z" fill="url(#paint0_linear)"/>
                    <defs>
                    <linearGradient id="paint0_linear" x1="10" y1="30" x2="30" y2="10" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#6673B4"/>
                    <stop offset="1" stop-color="#9EAEFF"/>
                    </linearGradient>
                    </defs>
                </svg>
            </a> -->
        </th>
    </tr>
</table>
<table id="2017" class="table_info tabcontent">
    <tr class="table_title">
        <th class="date">Date</th>
        <th class="status">Status and ID</th>
        <th class="engines">Engines</th>
        <th class="amount">Amount</th>

    </tr>
    <tr class="accordion">
        <td>Jun 15, 2017, 00:00</td>
        <td class="status green">46279279SO</td>
        <td>2: <span>Fd, Er</span></td>
        <td>$20.77</td>
    </tr>
    <tr class="hidden-panel">
        <td></td>
        <td></td>
        <td>Face detector <br />
            Emotion recognition</td>
        <td>$24.75 <br />$8.00</td>
    </tr>
    <tr class="accordion">
        <td>May 15, 2017, 00:00</td>
        <td class="status green">985R36FJK7</td>
        <td>2: Fd, Er</td>
        <td>$41.22</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Apr 15, 2017, 00:00</td>
        <td class="status green">4627DL3746</td>
        <td>2: Fd, Er</td>
        <td>$16.45</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Mar 15, 2017, 09:45</td>
        <td class="status green">CD36235R36</td>
        <td>2: Fd, Er</td>
        <td>$48.98</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Mar 15, 2017, 00:00</td>
        <td class="status red">23746279GF</td>
        <td>2: Fd, Er</td>
        <td>$37.11</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Feb 15, 2017, 00:00</td>
        <td class="status red">75011279GF</td>
        <td>1</td>
        <td>$34.00</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Jan 15, 2017, 00:00</td>
        <td class="status green">35R36CD362</td>
        <td>1: Fd</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
</table>
<table id="2018" class="table_info tabcontent">
    <tr class="table_title">
        <th class="date">Date</th>
        <th class="status">Status and ID</th>
        <th class="engines">Engines</th>
        <th class="amount">Amount</th>

    </tr>
    <tr class="accordion">
        <td>Jun 15, 2018, 00:00</td>
        <td class="status green">46279279SO</td>
        <td>2: <span>Fd, Er</span></td>
        <td>$20.77</td>
    </tr>
    <tr class="hidden-panel">
        <td></td>
        <td></td>
        <td>Face detector <br />
            Emotion recognition</td>
        <td>$24.75 <br />$8.00</td>
    </tr>
    <tr class="accordion">
        <td>May 15, 2018, 00:00</td>
        <td class="status green">985R36FJK7</td>
        <td>2: Fd, Er</td>
        <td>$41.22</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Apr 15, 2018, 00:00</td>
        <td class="status green">4627DL3746</td>
        <td>2: Fd, Er</td>
        <td>$16.45</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Mar 15, 2018, 09:45</td>
        <td class="status green">CD36235R36</td>
        <td>2: Fd, Er</td>
        <td>$48.98</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Mar 15, 2018, 00:00</td>
        <td class="status red">23746279GF</td>
        <td>2: Fd, Er</td>
        <td>$37.11</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Feb 15, 2018, 00:00</td>
        <td class="status red">75011279GF</td>
        <td>1</td>
        <td>$34.00</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="accordion">
        <td>Jan 15, 2018, 00:00</td>
        <td class="status green">35R36CD362</td>
        <td>1: Fd</td>
    </tr>
    <tr class="hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
</table>
<table id="2019" style="display: block;" class="table_info tabcontent">
    <tr class="table_title">
        <th class="date">Date</th>
        <th class="status">Status and ID</th>
        <th class="engines">Engines</th>
        <th class="amount">Amount</th>

    </tr>
    <tr class="table-row accordion">
        <td>Jun 15, 2019, 00:00</td>
        <td class="status green">46279279SO</td>
        <td>2: <span>Fd, Er</span></td>
        <td>$20.77</td>
    </tr>
    <tr class="table-row hidden-panel">
        <td></td>
        <td></td>
        <td>Face detector <br />
            Emotion recognition</td>
        <td>$24.75 <br />$8.00</td>
    </tr>
    <tr class="table-row accordion">
        <td>May 15, 2019, 00:00</td>
        <td class="status green">985R36FJK7</td>
        <td>2: Fd, Er</td>
        <td>$41.22</td>
    </tr>
    <tr class="table-row hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="table-row accordion">
        <td>Apr 15, 2019, 00:00</td>
        <td class="status green">4627DL3746</td>
        <td>2: Fd, Er</td>
        <td>$16.45</td>
    </tr>
    <tr class="table-row hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="table-row accordion">
        <td>Mar 15, 2019, 09:45</td>
        <td class="status green">CD36235R36</td>
        <td>2: Fd, Er</td>
        <td>$48.98</td>
    </tr>
    <tr class="table-row hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="table-row accordion">
        <td>Mar 15, 2019, 00:00</td>
        <td class="status red">23746279GF</td>
        <td>2: Fd, Er</td>
        <td>$37.11</td>
    </tr>
    <tr class="table-row hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="table-row accordion">
        <td>Feb 15, 2019, 00:00</td>
        <td class="status red">75011279GF</td>
        <td>1</td>
        <td>$34.00</td>
    </tr>
    <tr class="table-row hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
    <tr class="table-row accordion">
        <td>Jan 15, 2019, 00:00</td>
        <td class="status green">35R36CD362</td>
        <td>1: Fd</td>
    </tr>
    <tr class="table-row hidden-panel">
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
        <td>hidden</td>
    </tr>
</table>
