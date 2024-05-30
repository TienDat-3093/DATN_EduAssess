@extends('layout')

@section('content')

<!--  Row 1 -->
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Sales Overview</h5>
                    </div>
                    <div>
                        <select class="form-select">
                            <option value="1">March 2023</option>
                            <option value="2">April 2023</option>
                            <option value="3">May 2023</option>
                            <option value="4">June 2023</option>
                        </select>
                    </div>
                </div>
                <div id="chart" style="min-height: 360px;">
                    <div id="apexchartsfjzrdndfl" class="apexcharts-canvas apexchartsfjzrdndfl apexcharts-theme-light" style="width: 675px; height: 345px;"><svg id="SvgjsSvg1654" width="675" height="345" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(-15, 0)" style="background: transparent;">
                            <g id="SvgjsG1656" class="apexcharts-inner apexcharts-graphical" transform="translate(50.03750038146973, 30)">
                                <defs id="SvgjsDefs1655">
                                    <linearGradient id="SvgjsLinearGradient1660" x1="0" y1="0" x2="0" y2="1">
                                        <stop id="SvgjsStop1661" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                        <stop id="SvgjsStop1662" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                        <stop id="SvgjsStop1663" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                    </linearGradient>
                                    <clipPath id="gridRectMaskfjzrdndfl">
                                        <rect id="SvgjsRect1665" width="621.9624996185303" height="278.406400308609" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                    </clipPath>
                                    <clipPath id="forecastMaskfjzrdndfl"></clipPath>
                                    <clipPath id="nonForecastMaskfjzrdndfl"></clipPath>
                                    <clipPath id="gridRectMarkerMaskfjzrdndfl">
                                        <rect id="SvgjsRect1666" width="618.9624996185303" height="279.406400308609" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                    </clipPath>
                                </defs>
                                <rect id="SvgjsRect1664" width="13.45230467915535" height="275.406400308609" x="21.629682859778406" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1660)" class="apexcharts-xcrosshairs" y2="275.406400308609" filter="none" fill-opacity="0.9" x1="21.629682859778406" x2="21.629682859778406"></rect>
                                <line id="SvgjsLine1710" x1="0" y1="276.406400308609" x2="0" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1711" x1="76.87031245231628" y1="276.406400308609" x2="76.87031245231628" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1712" x1="153.74062490463257" y1="276.406400308609" x2="153.74062490463257" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1713" x1="230.61093735694885" y1="276.406400308609" x2="230.61093735694885" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1714" x1="307.48124980926514" y1="276.406400308609" x2="307.48124980926514" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1715" x1="384.3515622615814" y1="276.406400308609" x2="384.3515622615814" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1716" x1="461.2218747138977" y1="276.406400308609" x2="461.2218747138977" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1717" x1="538.092187166214" y1="276.406400308609" x2="538.092187166214" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <line id="SvgjsLine1718" x1="614.9624996185303" y1="276.406400308609" x2="614.9624996185303" y2="282.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line>
                                <g id="SvgjsG1726" class="apexcharts-xaxis" transform="translate(0, 0)">
                                    <g id="SvgjsG1727" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1729" font-family="inherit" x="38.43515622615814" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1730">16/08</tspan>
                                            <title>16/08</title>
                                        </text><text id="SvgjsText1732" font-family="inherit" x="115.30546867847443" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1733">17/08</tspan>
                                            <title>17/08</title>
                                        </text><text id="SvgjsText1735" font-family="inherit" x="192.1757811307907" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1736">18/08</tspan>
                                            <title>18/08</title>
                                        </text><text id="SvgjsText1738" font-family="inherit" x="269.046093583107" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1739">19/08</tspan>
                                            <title>19/08</title>
                                        </text><text id="SvgjsText1741" font-family="inherit" x="345.9164060354233" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1742">20/08</tspan>
                                            <title>20/08</title>
                                        </text><text id="SvgjsText1744" font-family="inherit" x="422.78671848773956" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1745">21/08</tspan>
                                            <title>21/08</title>
                                        </text><text id="SvgjsText1747" font-family="inherit" x="499.65703094005585" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1748">22/08</tspan>
                                            <title>22/08</title>
                                        </text><text id="SvgjsText1750" font-family="inherit" x="576.5273433923721" y="304.406400308609" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                            <tspan id="SvgjsTspan1751">23/08</tspan>
                                            <title>23/08</title>
                                        </text></g>
                                </g>
                                <g id="SvgjsG1706" class="apexcharts-grid">
                                    <g id="SvgjsG1707" class="apexcharts-gridlines-horizontal">
                                        <line id="SvgjsLine1720" x1="0" y1="68.85160007715226" x2="614.9624996185303" y2="68.85160007715226" stroke="rgba(0,0,0,0.1)" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1721" x1="0" y1="137.7032001543045" x2="614.9624996185303" y2="137.7032001543045" stroke="rgba(0,0,0,0.1)" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1722" x1="0" y1="206.55480023145677" x2="614.9624996185303" y2="206.55480023145677" stroke="rgba(0,0,0,0.1)" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                    </g>
                                    <g id="SvgjsG1708" class="apexcharts-gridlines-vertical"></g>
                                    <line id="SvgjsLine1725" x1="0" y1="275.406400308609" x2="614.9624996185303" y2="275.406400308609" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                    <line id="SvgjsLine1724" x1="0" y1="1" x2="0" y2="275.406400308609" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                </g>
                                <g id="SvgjsG1667" class="apexcharts-bar-series apexcharts-plot-series">
                                    <g id="SvgjsG1668" class="apexcharts-series" rel="1" seriesName="Earningsxthisxmonthx" data:realIndex="0">
                                        <path id="SvgjsPath1672" d="M 24.98285154700279 275.407400308609 L 24.98285154700279 36.984220034718504 C 24.98285154700279 33.984220034718504 27.98285154700279 30.9842200347185 30.98285154700279 30.9842200347185 L 30.98285154700279 30.9842200347185 C 33.20900388658047 30.9842200347185 35.43515622615814 33.984220034718504 35.43515622615814 36.984220034718504 L 35.43515622615814 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 24.98285154700279 275.407400308609 L 24.98285154700279 36.984220034718504 C 24.98285154700279 33.984220034718504 27.98285154700279 30.9842200347185 30.98285154700279 30.9842200347185 L 30.98285154700279 30.9842200347185 C 33.20900388658047 30.9842200347185 35.43515622615814 33.984220034718504 35.43515622615814 36.984220034718504 L 35.43515622615814 275.407400308609 z " pathFrom="M 24.98285154700279 275.407400308609 L 24.98285154700279 275.407400308609 L 35.43515622615814 275.407400308609 L 35.43515622615814 275.407400308609 L 35.43515622615814 275.407400308609 L 35.43515622615814 275.407400308609 L 35.43515622615814 275.407400308609 L 24.98285154700279 275.407400308609 z" cy="30.9832200347185" cx="100.35316399931908" j="0" val="355" barHeight="244.42318027389052" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1674" d="M 101.85316399931908 275.407400308609 L 101.85316399931908 12.88616000771523 C 101.85316399931908 9.88616000771523 104.85316399931908 6.886160007715229 107.85316399931908 6.886160007715229 L 107.85316399931908 6.886160007715229 C 110.07931633889675 6.886160007715229 112.30546867847443 9.88616000771523 112.30546867847443 12.88616000771523 L 112.30546867847443 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 101.85316399931908 275.407400308609 L 101.85316399931908 12.88616000771523 C 101.85316399931908 9.88616000771523 104.85316399931908 6.886160007715229 107.85316399931908 6.886160007715229 L 107.85316399931908 6.886160007715229 C 110.07931633889675 6.886160007715229 112.30546867847443 9.88616000771523 112.30546867847443 12.88616000771523 L 112.30546867847443 275.407400308609 z " pathFrom="M 101.85316399931908 275.407400308609 L 101.85316399931908 275.407400308609 L 112.30546867847443 275.407400308609 L 112.30546867847443 275.407400308609 L 112.30546867847443 275.407400308609 L 112.30546867847443 275.407400308609 L 112.30546867847443 275.407400308609 L 101.85316399931908 275.407400308609 z" cy="6.885160007715228" cx="177.22347645163535" j="1" val="390" barHeight="268.5212403008938" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1676" d="M 178.72347645163535 275.407400308609 L 178.72347645163535 74.85260007715226 C 178.72347645163535 71.85260007715226 181.72347645163535 68.85260007715226 184.72347645163535 68.85260007715226 L 184.72347645163535 68.85260007715226 C 186.94962879121303 68.85260007715226 189.1757811307907 71.85260007715226 189.1757811307907 74.85260007715226 L 189.1757811307907 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 178.72347645163535 275.407400308609 L 178.72347645163535 74.85260007715226 C 178.72347645163535 71.85260007715226 181.72347645163535 68.85260007715226 184.72347645163535 68.85260007715226 L 184.72347645163535 68.85260007715226 C 186.94962879121303 68.85260007715226 189.1757811307907 71.85260007715226 189.1757811307907 74.85260007715226 L 189.1757811307907 275.407400308609 z " pathFrom="M 178.72347645163535 275.407400308609 L 178.72347645163535 275.407400308609 L 189.1757811307907 275.407400308609 L 189.1757811307907 275.407400308609 L 189.1757811307907 275.407400308609 L 189.1757811307907 275.407400308609 L 189.1757811307907 275.407400308609 L 178.72347645163535 275.407400308609 z" cy="68.85160007715226" cx="254.09378890395163" j="2" val="300" barHeight="206.55480023145677" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1678" d="M 255.59378890395163 275.407400308609 L 255.59378890395163 40.42680003857611 C 255.59378890395163 37.42680003857611 258.59378890395163 34.42680003857611 261.59378890395163 34.42680003857611 L 261.59378890395163 34.42680003857611 C 263.81994124352934 34.42680003857611 266.046093583107 37.42680003857611 266.046093583107 40.42680003857611 L 266.046093583107 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 255.59378890395163 275.407400308609 L 255.59378890395163 40.42680003857611 C 255.59378890395163 37.42680003857611 258.59378890395163 34.42680003857611 261.59378890395163 34.42680003857611 L 261.59378890395163 34.42680003857611 C 263.81994124352934 34.42680003857611 266.046093583107 37.42680003857611 266.046093583107 40.42680003857611 L 266.046093583107 275.407400308609 z " pathFrom="M 255.59378890395163 275.407400308609 L 255.59378890395163 275.407400308609 L 266.046093583107 275.407400308609 L 266.046093583107 275.407400308609 L 266.046093583107 275.407400308609 L 266.046093583107 275.407400308609 L 266.046093583107 275.407400308609 L 255.59378890395163 275.407400308609 z" cy="34.425800038576114" cx="330.9641013562679" j="3" val="350" barHeight="240.9806002700329" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1680" d="M 332.4641013562679 275.407400308609 L 332.4641013562679 12.88616000771523 C 332.4641013562679 9.88616000771523 335.4641013562679 6.886160007715229 338.4641013562679 6.886160007715229 L 338.4641013562679 6.886160007715229 C 340.6902536958456 6.886160007715229 342.9164060354233 9.88616000771523 342.9164060354233 12.88616000771523 L 342.9164060354233 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 332.4641013562679 275.407400308609 L 332.4641013562679 12.88616000771523 C 332.4641013562679 9.88616000771523 335.4641013562679 6.886160007715229 338.4641013562679 6.886160007715229 L 338.4641013562679 6.886160007715229 C 340.6902536958456 6.886160007715229 342.9164060354233 9.88616000771523 342.9164060354233 12.88616000771523 L 342.9164060354233 275.407400308609 z " pathFrom="M 332.4641013562679 275.407400308609 L 332.4641013562679 275.407400308609 L 342.9164060354233 275.407400308609 L 342.9164060354233 275.407400308609 L 342.9164060354233 275.407400308609 L 342.9164060354233 275.407400308609 L 342.9164060354233 275.407400308609 L 332.4641013562679 275.407400308609 z" cy="6.885160007715228" cx="407.8344138085842" j="4" val="390" barHeight="268.5212403008938" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1682" d="M 409.3344138085842 275.407400308609 L 409.3344138085842 157.47452016973497 C 409.3344138085842 154.47452016973497 412.3344138085842 151.47452016973497 415.3344138085842 151.47452016973497 L 415.3344138085842 151.47452016973497 C 417.5605661481619 151.47452016973497 419.78671848773956 154.47452016973497 419.78671848773956 157.47452016973497 L 419.78671848773956 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 409.3344138085842 275.407400308609 L 409.3344138085842 157.47452016973497 C 409.3344138085842 154.47452016973497 412.3344138085842 151.47452016973497 415.3344138085842 151.47452016973497 L 415.3344138085842 151.47452016973497 C 417.5605661481619 151.47452016973497 419.78671848773956 154.47452016973497 419.78671848773956 157.47452016973497 L 419.78671848773956 275.407400308609 z " pathFrom="M 409.3344138085842 275.407400308609 L 409.3344138085842 275.407400308609 L 419.78671848773956 275.407400308609 L 419.78671848773956 275.407400308609 L 419.78671848773956 275.407400308609 L 419.78671848773956 275.407400308609 L 419.78671848773956 275.407400308609 L 409.3344138085842 275.407400308609 z" cy="151.47352016973497" cx="484.7047262609005" j="5" val="180" barHeight="123.93288013887405" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1684" d="M 486.2047262609005 275.407400308609 L 486.2047262609005 36.984220034718504 C 486.2047262609005 33.984220034718504 489.2047262609005 30.9842200347185 492.2047262609005 30.9842200347185 L 492.2047262609005 30.9842200347185 C 494.4308786004782 30.9842200347185 496.65703094005585 33.984220034718504 496.65703094005585 36.984220034718504 L 496.65703094005585 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 486.2047262609005 275.407400308609 L 486.2047262609005 36.984220034718504 C 486.2047262609005 33.984220034718504 489.2047262609005 30.9842200347185 492.2047262609005 30.9842200347185 L 492.2047262609005 30.9842200347185 C 494.4308786004782 30.9842200347185 496.65703094005585 33.984220034718504 496.65703094005585 36.984220034718504 L 496.65703094005585 275.407400308609 z " pathFrom="M 486.2047262609005 275.407400308609 L 486.2047262609005 275.407400308609 L 496.65703094005585 275.407400308609 L 496.65703094005585 275.407400308609 L 496.65703094005585 275.407400308609 L 496.65703094005585 275.407400308609 L 496.65703094005585 275.407400308609 L 486.2047262609005 275.407400308609 z" cy="30.9832200347185" cx="561.5750387132168" j="6" val="355" barHeight="244.42318027389052" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1686" d="M 563.0750387132168 275.407400308609 L 563.0750387132168 12.88616000771523 C 563.0750387132168 9.88616000771523 566.0750387132168 6.886160007715229 569.0750387132168 6.886160007715229 L 569.0750387132168 6.886160007715229 C 571.3011910527945 6.886160007715229 573.5273433923721 9.88616000771523 573.5273433923721 12.88616000771523 L 573.5273433923721 275.407400308609 z " fill="rgba(93,135,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 563.0750387132168 275.407400308609 L 563.0750387132168 12.88616000771523 C 563.0750387132168 9.88616000771523 566.0750387132168 6.886160007715229 569.0750387132168 6.886160007715229 L 569.0750387132168 6.886160007715229 C 571.3011910527945 6.886160007715229 573.5273433923721 9.88616000771523 573.5273433923721 12.88616000771523 L 573.5273433923721 275.407400308609 z " pathFrom="M 563.0750387132168 275.407400308609 L 563.0750387132168 275.407400308609 L 573.5273433923721 275.407400308609 L 573.5273433923721 275.407400308609 L 573.5273433923721 275.407400308609 L 573.5273433923721 275.407400308609 L 573.5273433923721 275.407400308609 L 563.0750387132168 275.407400308609 z" cy="6.885160007715228" cx="638.4453511655331" j="7" val="390" barHeight="268.5212403008938" barWidth="13.45230467915535"></path>
                                        <g id="SvgjsG1670" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                                            <g id="SvgjsG1671" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1673" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1675" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1677" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1679" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1681" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1683" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1685" className="apexcharts-bar-goals-groups"></g>
                                        </g>
                                    </g>
                                    <g id="SvgjsG1687" class="apexcharts-series" rel="2" seriesName="Expensexthisxmonthx" data:realIndex="1">
                                        <path id="SvgjsPath1691" d="M 38.43515622615814 275.407400308609 L 38.43515622615814 88.62292009258272 C 38.43515622615814 85.62292009258272 41.43515622615814 82.62292009258272 44.43515622615814 82.62292009258272 L 44.43515622615814 82.62292009258272 C 46.661308565735816 82.62292009258272 48.88746090531349 85.62292009258272 48.88746090531349 88.62292009258272 L 48.88746090531349 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 38.43515622615814 275.407400308609 L 38.43515622615814 88.62292009258272 C 38.43515622615814 85.62292009258272 41.43515622615814 82.62292009258272 44.43515622615814 82.62292009258272 L 44.43515622615814 82.62292009258272 C 46.661308565735816 82.62292009258272 48.88746090531349 85.62292009258272 48.88746090531349 88.62292009258272 L 48.88746090531349 275.407400308609 z " pathFrom="M 38.43515622615814 275.407400308609 L 38.43515622615814 275.407400308609 L 48.88746090531349 275.407400308609 L 48.88746090531349 275.407400308609 L 48.88746090531349 275.407400308609 L 48.88746090531349 275.407400308609 L 48.88746090531349 275.407400308609 L 38.43515622615814 275.407400308609 z" cy="82.62192009258271" cx="113.80546867847443" j="0" val="280" barHeight="192.7844802160263" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1693" d="M 115.30546867847443 275.407400308609 L 115.30546867847443 109.27840011572837 C 115.30546867847443 106.27840011572837 118.30546867847443 103.27840011572837 121.30546867847443 103.27840011572837 L 121.30546867847443 103.27840011572837 C 123.5316210180521 103.27840011572837 125.75777335762979 106.27840011572837 125.75777335762979 109.27840011572837 L 125.75777335762979 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 115.30546867847443 275.407400308609 L 115.30546867847443 109.27840011572837 C 115.30546867847443 106.27840011572837 118.30546867847443 103.27840011572837 121.30546867847443 103.27840011572837 L 121.30546867847443 103.27840011572837 C 123.5316210180521 103.27840011572837 125.75777335762979 106.27840011572837 125.75777335762979 109.27840011572837 L 125.75777335762979 275.407400308609 z " pathFrom="M 115.30546867847443 275.407400308609 L 115.30546867847443 275.407400308609 L 125.75777335762979 275.407400308609 L 125.75777335762979 275.407400308609 L 125.75777335762979 275.407400308609 L 125.75777335762979 275.407400308609 L 125.75777335762979 275.407400308609 L 115.30546867847443 275.407400308609 z" cy="103.27740011572837" cx="190.6757811307907" j="1" val="250" barHeight="172.12900019288065" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1695" d="M 192.1757811307907 275.407400308609 L 192.1757811307907 57.63970005786418 C 192.1757811307907 54.63970005786418 195.1757811307907 51.63970005786418 198.1757811307907 51.63970005786418 L 198.1757811307907 51.63970005786418 C 200.4019334703684 51.63970005786418 202.62808580994607 54.63970005786418 202.62808580994607 57.63970005786418 L 202.62808580994607 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 192.1757811307907 275.407400308609 L 192.1757811307907 57.63970005786418 C 192.1757811307907 54.63970005786418 195.1757811307907 51.63970005786418 198.1757811307907 51.63970005786418 L 198.1757811307907 51.63970005786418 C 200.4019334703684 51.63970005786418 202.62808580994607 54.63970005786418 202.62808580994607 57.63970005786418 L 202.62808580994607 275.407400308609 z " pathFrom="M 192.1757811307907 275.407400308609 L 192.1757811307907 275.407400308609 L 202.62808580994607 275.407400308609 L 202.62808580994607 275.407400308609 L 202.62808580994607 275.407400308609 L 202.62808580994607 275.407400308609 L 202.62808580994607 275.407400308609 L 192.1757811307907 275.407400308609 z" cy="51.638700057864185" cx="267.546093583107" j="2" val="325" barHeight="223.76770025074484" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1697" d="M 269.046093583107 275.407400308609 L 269.046093583107 133.37646014273167 C 269.046093583107 130.37646014273167 272.046093583107 127.37646014273167 275.046093583107 127.37646014273167 L 275.046093583107 127.37646014273167 C 277.27224592268465 127.37646014273167 279.49839826226236 130.37646014273167 279.49839826226236 133.37646014273167 L 279.49839826226236 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 269.046093583107 275.407400308609 L 269.046093583107 133.37646014273167 C 269.046093583107 130.37646014273167 272.046093583107 127.37646014273167 275.046093583107 127.37646014273167 L 275.046093583107 127.37646014273167 C 277.27224592268465 127.37646014273167 279.49839826226236 130.37646014273167 279.49839826226236 133.37646014273167 L 279.49839826226236 275.407400308609 z " pathFrom="M 269.046093583107 275.407400308609 L 269.046093583107 275.407400308609 L 279.49839826226236 275.407400308609 L 279.49839826226236 275.407400308609 L 279.49839826226236 275.407400308609 L 279.49839826226236 275.407400308609 L 279.49839826226236 275.407400308609 L 269.046093583107 275.407400308609 z" cy="127.37546014273167" cx="344.4164060354233" j="3" val="215" barHeight="148.03094016587735" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1699" d="M 345.9164060354233 275.407400308609 L 345.9164060354233 109.27840011572837 C 345.9164060354233 106.27840011572837 348.9164060354233 103.27840011572837 351.9164060354233 103.27840011572837 L 351.9164060354233 103.27840011572837 C 354.14255837500093 103.27840011572837 356.36871071457864 106.27840011572837 356.36871071457864 109.27840011572837 L 356.36871071457864 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 345.9164060354233 275.407400308609 L 345.9164060354233 109.27840011572837 C 345.9164060354233 106.27840011572837 348.9164060354233 103.27840011572837 351.9164060354233 103.27840011572837 L 351.9164060354233 103.27840011572837 C 354.14255837500093 103.27840011572837 356.36871071457864 106.27840011572837 356.36871071457864 109.27840011572837 L 356.36871071457864 275.407400308609 z " pathFrom="M 345.9164060354233 275.407400308609 L 345.9164060354233 275.407400308609 L 356.36871071457864 275.407400308609 L 356.36871071457864 275.407400308609 L 356.36871071457864 275.407400308609 L 356.36871071457864 275.407400308609 L 356.36871071457864 275.407400308609 L 345.9164060354233 275.407400308609 z" cy="103.27740011572837" cx="421.28671848773956" j="4" val="250" barHeight="172.12900019288065" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1701" d="M 422.78671848773956 275.407400308609 L 422.78671848773956 67.96744006943703 C 422.78671848773956 64.96744006943703 425.78671848773956 61.967440069437025 428.78671848773956 61.967440069437025 L 428.78671848773956 61.967440069437025 C 431.0128708273172 61.967440069437025 433.2390231668949 64.96744006943703 433.2390231668949 67.96744006943703 L 433.2390231668949 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 422.78671848773956 275.407400308609 L 422.78671848773956 67.96744006943703 C 422.78671848773956 64.96744006943703 425.78671848773956 61.967440069437025 428.78671848773956 61.967440069437025 L 428.78671848773956 61.967440069437025 C 431.0128708273172 61.967440069437025 433.2390231668949 64.96744006943703 433.2390231668949 67.96744006943703 L 433.2390231668949 275.407400308609 z " pathFrom="M 422.78671848773956 275.407400308609 L 422.78671848773956 275.407400308609 L 433.2390231668949 275.407400308609 L 433.2390231668949 275.407400308609 L 433.2390231668949 275.407400308609 L 433.2390231668949 275.407400308609 L 433.2390231668949 275.407400308609 L 422.78671848773956 275.407400308609 z" cy="61.96644006943703" cx="498.15703094005585" j="5" val="310" barHeight="213.439960239172" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1703" d="M 499.65703094005585 275.407400308609 L 499.65703094005585 88.62292009258272 C 499.65703094005585 85.62292009258272 502.65703094005585 82.62292009258272 505.65703094005585 82.62292009258272 L 505.65703094005585 82.62292009258272 C 507.8831832796335 82.62292009258272 510.10933561921115 85.62292009258272 510.10933561921115 88.62292009258272 L 510.10933561921115 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 499.65703094005585 275.407400308609 L 499.65703094005585 88.62292009258272 C 499.65703094005585 85.62292009258272 502.65703094005585 82.62292009258272 505.65703094005585 82.62292009258272 L 505.65703094005585 82.62292009258272 C 507.8831832796335 82.62292009258272 510.10933561921115 85.62292009258272 510.10933561921115 88.62292009258272 L 510.10933561921115 275.407400308609 z " pathFrom="M 499.65703094005585 275.407400308609 L 499.65703094005585 275.407400308609 L 510.10933561921115 275.407400308609 L 510.10933561921115 275.407400308609 L 510.10933561921115 275.407400308609 L 510.10933561921115 275.407400308609 L 510.10933561921115 275.407400308609 L 499.65703094005585 275.407400308609 z" cy="82.62192009258271" cx="575.0273433923721" j="6" val="280" barHeight="192.7844802160263" barWidth="13.45230467915535"></path>
                                        <path id="SvgjsPath1705" d="M 576.5273433923721 275.407400308609 L 576.5273433923721 109.27840011572837 C 576.5273433923721 106.27840011572837 579.5273433923721 103.27840011572837 582.5273433923721 103.27840011572837 L 582.5273433923721 103.27840011572837 C 584.7534957319498 103.27840011572837 586.9796480715274 106.27840011572837 586.9796480715274 109.27840011572837 L 586.9796480715274 275.407400308609 z " fill="rgba(73,190,255,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskfjzrdndfl)" pathTo="M 576.5273433923721 275.407400308609 L 576.5273433923721 109.27840011572837 C 576.5273433923721 106.27840011572837 579.5273433923721 103.27840011572837 582.5273433923721 103.27840011572837 L 582.5273433923721 103.27840011572837 C 584.7534957319498 103.27840011572837 586.9796480715274 106.27840011572837 586.9796480715274 109.27840011572837 L 586.9796480715274 275.407400308609 z " pathFrom="M 576.5273433923721 275.407400308609 L 576.5273433923721 275.407400308609 L 586.9796480715274 275.407400308609 L 586.9796480715274 275.407400308609 L 586.9796480715274 275.407400308609 L 586.9796480715274 275.407400308609 L 586.9796480715274 275.407400308609 L 576.5273433923721 275.407400308609 z" cy="103.27740011572837" cx="651.8976558446884" j="7" val="250" barHeight="172.12900019288065" barWidth="13.45230467915535"></path>
                                        <g id="SvgjsG1689" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                                            <g id="SvgjsG1690" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1692" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1694" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1696" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1698" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1700" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1702" className="apexcharts-bar-goals-groups"></g>
                                            <g id="SvgjsG1704" className="apexcharts-bar-goals-groups"></g>
                                        </g>
                                    </g>
                                    <g id="SvgjsG1669" class="apexcharts-datalabels" data:realIndex="0"></g>
                                    <g id="SvgjsG1688" class="apexcharts-datalabels" data:realIndex="1"></g>
                                </g>
                                <g id="SvgjsG1709" class="apexcharts-grid-borders">
                                    <line id="SvgjsLine1719" x1="0" y1="0" x2="614.9624996185303" y2="0" stroke="rgba(0,0,0,0.1)" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine1723" x1="0" y1="275.406400308609" x2="614.9624996185303" y2="275.406400308609" stroke="rgba(0,0,0,0.1)" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine1752" x1="0" y1="276.406400308609" x2="614.9624996185303" y2="276.406400308609" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line>
                                </g>
                                <line id="SvgjsLine1770" x1="0" y1="0" x2="614.9624996185303" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                <line id="SvgjsLine1771" x1="0" y1="0" x2="614.9624996185303" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                <g id="SvgjsG1772" class="apexcharts-yaxis-annotations"></g>
                                <g id="SvgjsG1773" class="apexcharts-xaxis-annotations"></g>
                                <g id="SvgjsG1774" class="apexcharts-point-annotations"></g>
                            </g>
                            <g id="SvgjsG1753" class="apexcharts-yaxis" rel="0" transform="translate(20.037500381469727, 0)">
                                <g id="SvgjsG1754" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1756" font-family="inherit" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-yaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                        <tspan id="SvgjsTspan1757">400</tspan>
                                        <title>400</title>
                                    </text><text id="SvgjsText1759" font-family="inherit" x="20" y="100.25160007715226" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-yaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                        <tspan id="SvgjsTspan1760">300</tspan>
                                        <title>300</title>
                                    </text><text id="SvgjsText1762" font-family="inherit" x="20" y="169.10320015430452" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-yaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                        <tspan id="SvgjsTspan1763">200</tspan>
                                        <title>200</title>
                                    </text><text id="SvgjsText1765" font-family="inherit" x="20" y="237.95480023145677" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-yaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                        <tspan id="SvgjsTspan1766">100</tspan>
                                        <title>100</title>
                                    </text><text id="SvgjsText1768" font-family="inherit" x="20" y="306.806400308609" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#adb0bb" class="apexcharts-text apexcharts-yaxis-label grey--text lighten-2--text fill-color" style="font-family: inherit;">
                                        <tspan id="SvgjsTspan1769">0</tspan>
                                        <title>0</title>
                                    </text></g>
                            </g>
                            <g id="SvgjsG1657" class="apexcharts-annotations"></g>
                        </svg>
                        <div class="apexcharts-legend" style="max-height: 172.5px;"></div>
                        <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 78.3933px; top: 25.3px;">
                            <div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;">16/08</div>
                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(93, 135, 255, 0.85);"></span>
                                <div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;">
                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Earnings this month:: </span><span class="apexcharts-tooltip-text-y-value">355</span></div>
                                    <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                </div>
                            </div>
                            <div class="apexcharts-tooltip-series-group" style="order: 2; display: none;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(93, 135, 255, 0.85);"></span>
                                <div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;">
                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Earnings this month:: </span><span class="apexcharts-tooltip-text-y-value">355</span></div>
                                    <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                            <div class="apexcharts-yaxistooltip-text"></div>
                        </div>
                        <div class="apexcharts-toolbar" style="top: 0px; right: 3px;">
                            <div class="apexcharts-menu-icon" title="Menu"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                    <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
                                </svg></div>
                            <div class="apexcharts-menu">
                                <div class="apexcharts-menu-item exportSVG" title="Download SVG">Download SVG</div>
                                <div class="apexcharts-menu-item exportPNG" title="Download PNG">Download PNG</div>
                                <div class="apexcharts-menu-item exportCSV" title="Download CSV">Download CSV</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">$36,358</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                    <p class="fs-3 mb-0">last year</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="me-4">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">2023</span>
                                    </div>
                                    <div>
                                        <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">2023</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div id="breakup" style="min-height: 128.7px;">
                                        <div id="apexchartsq80une0w" class="apexcharts-canvas apexchartsq80une0w apexcharts-theme-light" style="width: 180px; height: 128.7px;"><svg id="SvgjsSvg1775" width="180" height="128.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                                <g id="SvgjsG1777" class="apexcharts-inner apexcharts-graphical" transform="translate(28, 0)">
                                                    <defs id="SvgjsDefs1776">
                                                        <clipPath id="gridRectMaskq80une0w">
                                                            <rect id="SvgjsRect1779" width="132" height="150" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMaskq80une0w"></clipPath>
                                                        <clipPath id="nonForecastMaskq80une0w"></clipPath>
                                                        <clipPath id="gridRectMarkerMaskq80une0w">
                                                            <rect id="SvgjsRect1780" width="130" height="152" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g id="SvgjsG1781" class="apexcharts-pie">
                                                        <g id="SvgjsG1782" transform="translate(0, 0) scale(1)">
                                                            <circle id="SvgjsCircle1783" r="41.59756097560976" cx="63" cy="63" fill="transparent"></circle>
                                                            <g id="SvgjsG1784" class="apexcharts-slices">
                                                                <g id="SvgjsG1785" class="apexcharts-series apexcharts-pie-series" seriesName="2022" rel="1" data:realIndex="0">
                                                                    <path id="SvgjsPath1786" d="M 63 7.536585365853654 A 55.463414634146346 55.463414634146346 0 0 1 103.6849453198706 100.69516662913668 L 93.51370898990294 91.27137497185251 A 41.59756097560976 41.59756097560976 0 0 0 63 21.40243902439024 L 63 7.536585365853654 z" fill="rgba(93,135,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="132.81553398058253" data:startAngle="0" data:strokeWidth="0" data:value="38" data:pathOrig="M 63 7.536585365853654 A 55.463414634146346 55.463414634146346 0 0 1 103.6849453198706 100.69516662913668 L 93.51370898990294 91.27137497185251 A 41.59756097560976 41.59756097560976 0 0 0 63 21.40243902439024 L 63 7.536585365853654 z"></path>
                                                                </g>
                                                                <g id="SvgjsG1787" class="apexcharts-series apexcharts-pie-series" seriesName="2021" rel="2" data:realIndex="1">
                                                                    <path id="SvgjsPath1788" d="M 103.6849453198706 100.69516662913668 A 55.463414634146346 55.463414634146346 0 0 1 7.594622861729029 60.463359102040855 L 21.445967146296773 61.097519326530644 A 41.59756097560976 41.59756097560976 0 0 0 93.51370898990294 91.27137497185251 L 103.6849453198706 100.69516662913668 z" fill="rgba(236,242,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="139.8058252427184" data:startAngle="132.81553398058253" data:strokeWidth="0" data:value="40" data:pathOrig="M 103.6849453198706 100.69516662913668 A 55.463414634146346 55.463414634146346 0 0 1 7.594622861729029 60.463359102040855 L 21.445967146296773 61.097519326530644 A 41.59756097560976 41.59756097560976 0 0 0 93.51370898990294 91.27137497185251 L 103.6849453198706 100.69516662913668 z"></path>
                                                                </g>
                                                                <g id="SvgjsG1789" class="apexcharts-series apexcharts-pie-series" seriesName="2020" rel="3" data:realIndex="2">
                                                                    <path id="SvgjsPath1790" d="M 7.594622861729029 60.463359102040855 A 55.463414634146346 55.463414634146346 0 0 1 62.99031980805149 7.536586210609762 L 62.99273985603862 21.402439657957324 A 41.59756097560976 41.59756097560976 0 0 0 21.445967146296773 61.097519326530644 L 7.594622861729029 60.463359102040855 z" fill="rgba(249,249,253,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="87.37864077669906" data:startAngle="272.62135922330094" data:strokeWidth="0" data:value="25" data:pathOrig="M 7.594622861729029 60.463359102040855 A 55.463414634146346 55.463414634146346 0 0 1 62.99031980805149 7.536586210609762 L 62.99273985603862 21.402439657957324 A 41.59756097560976 41.59756097560976 0 0 0 21.445967146296773 61.097519326530644 L 7.594622861729029 60.463359102040855 z"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1791" x1="0" y1="0" x2="126" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1792" x1="0" y1="0" x2="126" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                                </g>
                                                <g id="SvgjsG1778" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(93, 135, 255);"></span>
                                                    <div class="apexcharts-tooltip-text" style="font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(236, 242, 255);"></span>
                                                    <div class="apexcharts-tooltip-text" style="font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(249, 249, 253);"></span>
                                                    <div class="apexcharts-tooltip-text" style="font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                                <h4 class="fw-semibold mb-3">$6,820</h4>
                                <div class="d-flex align-items-center pb-1">
                                    <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-down-right text-danger"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                    <p class="fs-3 mb-0">last year</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-currency-dollar fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="earning" style="min-height: 60px;">
                        <div id="apexchartssparkline3" class="apexcharts-canvas apexchartssparkline3 apexcharts-theme-light" style="width: 355px; height: 60px;"><svg id="SvgjsSvg1794" width="355" height="60" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                <g id="SvgjsG1796" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                    <defs id="SvgjsDefs1795">
                                        <clipPath id="gridRectMaskh5ioq17nh">
                                            <rect id="SvgjsRect1801" width="361" height="62" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="forecastMaskh5ioq17nh"></clipPath>
                                        <clipPath id="nonForecastMaskh5ioq17nh"></clipPath>
                                        <clipPath id="gridRectMarkerMaskh5ioq17nh">
                                            <rect id="SvgjsRect1802" width="359" height="64" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                    </defs>
                                    <line id="SvgjsLine1800" x1="0" y1="0" x2="0" y2="60" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="60" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                    <g id="SvgjsG1823" class="apexcharts-xaxis" transform="translate(0, 0)">
                                        <g id="SvgjsG1824" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                    </g>
                                    <g id="SvgjsG1809" class="apexcharts-grid">
                                        <g id="SvgjsG1810" class="apexcharts-gridlines-horizontal" style="display: none;">
                                            <line id="SvgjsLine1814" x1="0" y1="8.571428571428571" x2="355" y2="8.571428571428571" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1815" x1="0" y1="17.142857142857142" x2="355" y2="17.142857142857142" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1816" x1="0" y1="25.714285714285715" x2="355" y2="25.714285714285715" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1817" x1="0" y1="34.285714285714285" x2="355" y2="34.285714285714285" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1818" x1="0" y1="42.857142857142854" x2="355" y2="42.857142857142854" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1819" x1="0" y1="51.42857142857142" x2="355" y2="51.42857142857142" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1820" x1="0" y1="59.99999999999999" x2="355" y2="59.99999999999999" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                        </g>
                                        <g id="SvgjsG1811" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                        <line id="SvgjsLine1822" x1="0" y1="60" x2="355" y2="60" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                        <line id="SvgjsLine1821" x1="0" y1="1" x2="0" y2="60" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                    </g>
                                    <g id="SvgjsG1803" class="apexcharts-area-series apexcharts-plot-series">
                                        <g id="SvgjsG1804" class="apexcharts-series" seriesName="Earnings" data:longestSeries="true" rel="1" data:realIndex="0">
                                            <path id="SvgjsPath1807" d="M 0 60 L 0 38.57142857142857C 20.708333333333332 38.57142857142857 38.45833333333334 3.4285714285714306 59.16666666666667 3.4285714285714306C 79.875 3.4285714285714306 97.62500000000001 42.85714285714286 118.33333333333334 42.85714285714286C 139.04166666666669 42.85714285714286 156.79166666666669 25.714285714285715 177.50000000000003 25.714285714285715C 198.20833333333337 25.714285714285715 215.95833333333337 49.714285714285715 236.66666666666669 49.714285714285715C 257.375 49.714285714285715 275.12500000000006 10.285714285714292 295.83333333333337 10.285714285714292C 316.5416666666667 10.285714285714292 334.29166666666674 42.85714285714286 355.00000000000006 42.85714285714286C 355.00000000000006 42.85714285714286 355.00000000000006 42.85714285714286 355.00000000000006 60M 355.00000000000006 42.85714285714286z" fill="rgba(73,190,255,0.05)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskh5ioq17nh)" pathTo="M 0 60 L 0 38.57142857142857C 20.708333333333332 38.57142857142857 38.45833333333334 3.4285714285714306 59.16666666666667 3.4285714285714306C 79.875 3.4285714285714306 97.62500000000001 42.85714285714286 118.33333333333334 42.85714285714286C 139.04166666666669 42.85714285714286 156.79166666666669 25.714285714285715 177.50000000000003 25.714285714285715C 198.20833333333337 25.714285714285715 215.95833333333337 49.714285714285715 236.66666666666669 49.714285714285715C 257.375 49.714285714285715 275.12500000000006 10.285714285714292 295.83333333333337 10.285714285714292C 316.5416666666667 10.285714285714292 334.29166666666674 42.85714285714286 355.00000000000006 42.85714285714286C 355.00000000000006 42.85714285714286 355.00000000000006 42.85714285714286 355.00000000000006 60M 355.00000000000006 42.85714285714286z" pathFrom="M -1 60 L -1 60 L 59.16666666666667 60 L 118.33333333333334 60 L 177.50000000000003 60 L 236.66666666666669 60 L 295.83333333333337 60 L 355.00000000000006 60"></path>
                                            <path id="SvgjsPath1808" d="M 0 38.57142857142857C 20.708333333333332 38.57142857142857 38.45833333333334 3.4285714285714306 59.16666666666667 3.4285714285714306C 79.875 3.4285714285714306 97.62500000000001 42.85714285714286 118.33333333333334 42.85714285714286C 139.04166666666669 42.85714285714286 156.79166666666669 25.714285714285715 177.50000000000003 25.714285714285715C 198.20833333333337 25.714285714285715 215.95833333333337 49.714285714285715 236.66666666666669 49.714285714285715C 257.375 49.714285714285715 275.12500000000006 10.285714285714292 295.83333333333337 10.285714285714292C 316.5416666666667 10.285714285714292 334.29166666666674 42.85714285714286 355.00000000000006 42.85714285714286" fill="none" fill-opacity="1" stroke="#49beff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskh5ioq17nh)" pathTo="M 0 38.57142857142857C 20.708333333333332 38.57142857142857 38.45833333333334 3.4285714285714306 59.16666666666667 3.4285714285714306C 79.875 3.4285714285714306 97.62500000000001 42.85714285714286 118.33333333333334 42.85714285714286C 139.04166666666669 42.85714285714286 156.79166666666669 25.714285714285715 177.50000000000003 25.714285714285715C 198.20833333333337 25.714285714285715 215.95833333333337 49.714285714285715 236.66666666666669 49.714285714285715C 257.375 49.714285714285715 275.12500000000006 10.285714285714292 295.83333333333337 10.285714285714292C 316.5416666666667 10.285714285714292 334.29166666666674 42.85714285714286 355.00000000000006 42.85714285714286" pathFrom="M -1 60 L -1 60 L 59.16666666666667 60 L 118.33333333333334 60 L 177.50000000000003 60 L 236.66666666666669 60 L 295.83333333333337 60 L 355.00000000000006 60" fill-rule="evenodd"></path>
                                            <g id="SvgjsG1805" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                                <g class="apexcharts-series-markers">
                                                    <circle id="SvgjsCircle1838" r="0" cx="0" cy="0" class="apexcharts-marker wqw5cdddpl no-pointer-events" stroke="#ffffff" fill="#49beff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                </g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG1806" class="apexcharts-datalabels" data:realIndex="0"></g>
                                    </g>
                                    <g id="SvgjsG1812" class="apexcharts-grid-borders" style="display: none;">
                                        <line id="SvgjsLine1813" x1="0" y1="0" x2="355" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                    </g>
                                    <line id="SvgjsLine1833" x1="0" y1="0" x2="355" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine1834" x1="0" y1="0" x2="355" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                    <g id="SvgjsG1835" class="apexcharts-yaxis-annotations"></g>
                                    <g id="SvgjsG1836" class="apexcharts-xaxis-annotations"></g>
                                    <g id="SvgjsG1837" class="apexcharts-point-annotations"></g>
                                </g>
                                <rect id="SvgjsRect1799" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                <g id="SvgjsG1832" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                                <g id="SvgjsG1797" class="apexcharts-annotations"></g>
                            </svg>
                            <div class="apexcharts-legend" style="max-height: 30px;"></div>
                            <div class="apexcharts-tooltip apexcharts-theme-dark">
                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(73, 190, 255);"></span>
                                    <div class="apexcharts-tooltip-text" style="font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Recent Transactions</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">Payment was made of $64.95 to Michael</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New arrival recorded
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">Payment Done</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Assigned</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Priority</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Budget</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">1</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                    <span class="fw-normal">Web Designer</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Elite Admin</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">2</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Real Homes WP Theme</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-secondary rounded-3 fw-semibold">Medium</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$24.5k</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">3</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">MedicalPro WP Theme</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger rounded-3 fw-semibold">High</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$12.8k</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">4</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                                    <span class="fw-normal">Frontend Engineer</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Hosting Press HTML</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-success rounded-3 fw-semibold">Critical</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$2.4k</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s4.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Boat Headphone</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$50 <span class="ms-2 fw-normal text-muted fs-3"><del>$65</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s5.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">MacBook Air Pro</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$650 <span class="ms-2 fw-normal text-muted fs-3"><del>$900</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s7.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Red Valvet Dress</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$150 <span class="ms-2 fw-normal text-muted fs-3"><del>$200</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s11.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
            </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Cute Soft Teddybear</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold fs-4 mb-0">$285 <span class="ms-2 fw-normal text-muted fs-3"><del>$345</del></span></h6>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
</div>


@endsection
