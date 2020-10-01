<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/searchView.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.0.0/sweetalert.min.js"></script>
    <title>专利检索</title>
</head>

<body>
    <div class="area">

        <div class="container">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <nav class="row justify-content-center">欢迎使用山东理工大学，专利检索系统</nav>
            <form method="POST" id="form1">
                {{ csrf_field() }}
                <ul class="container">
                    <!-- 0 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control col-3" placeholder="标题" disabled>
                            <input type="text" class="form-control" id="title" name="title" placeholder="例如:太阳能电池">
                        </div>
                    </li>
                    <!-- 1 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="abstract_option" id="select1">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="摘要" disabled>
                            <input type="text" class="form-control" id="abstract" name="abstract" placeholder="例如:太阳能电池">
                        </div>
                    </li>
                    <!-- 2 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="demands_option" id="select2">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="权利要求" disabled>
                            <input type="text" class="form-control" id="demands" name="demands" placeholder="例如:太阳能">
                        </div>
                    </li>
                    <!-- 3 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="demand_option" id="select3">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="独立权利要求" disabled>
                            <input type="text" class="form-control" id="demand" name="demand" placeholder="例如:太阳能电池">
                        </div>
                    </li>
                    <!-- 4 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="introduction_option" id="select4">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="说明书" disabled>
                            <input type="text" class="form-control" id="introduction" name="introduction" placeholder="例如:太阳能电池">
                        </div>
                    </li>
                    <!-- t5 -->
                    <li class=" field-item time">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="ask_begin_date_option" id="select5">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="申请日" disabled>
                            <input type="date" class="form-control" id="ask_begin_date" name="ask_begin_date" placeholder="例如:132465789">
                            <!-- <span class="input-group-text">到</span> -->
                            <div class="timedao">
                                <input type="text" class="input-group-text form-control" style="width:50px;" placeholder="到" disabled>
                            </div>
                            <input type="date" class="form-control" id="ask_over_date" name="ask_over_date" placeholder="例如:132465789">
                        </div>
                    </li>
                    <!-- t6 -->
                    <li class=" field-item time">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="public_begin_date_option" id="select6">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="公开公告日" disabled>
                            <input type="date" class="form-control" id="public_begin_date" name="public_begin_date" placeholder="例如:132465789">
                            <!-- <span class="input-group-text">到</span> -->
                            <div class="timedao">
                                <input type="text" class="input-group-text form-control" style="width:50px;" placeholder="到" disabled>
                            </div>
                            <input type="date" class="form-control" id="public_over_date" name="public_over_date" placeholder="例如:132465789">
                        </div>
                    </li>
                    <!-- t7 -->
                    <li class=" field-item time">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="priority_begin_date_option" id="select7">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="优先权日" disabled>
                            <input type="date" class="form-control" id="priority_begin_date" name="priority_begin_date" placeholder="例如:132465789">
                            <!-- <span class="input-group-text">到</span> -->
                            <div class="timedao">
                                <input type="text" class="input-group-text form-control" style="width:50px;" placeholder="到" disabled>
                            </div>
                            <input type="date" class="form-control" id="priority_over_date" name="priority_over_date" placeholder="例如:132465789">
                        </div>
                    </li>
                    <!-- 8 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="public_number_option" id="select8">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="公开(公告)号" disabled>
                            <input type="text" class="form-control" id="public_number" name="public_number" placeholder="例如:US123456">
                        </div>
                    </li>
                    <!-- 9 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="ask_number_option" id="select9">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="申请号" disabled>
                            <input type="text" class="form-control" id="ask_number" name="ask_number" placeholder="例如:US10/123456">
                        </div>
                    </li>
                    <!-- 10 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="priority_number_option" id="select10">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="优先权号" disabled>
                            <input type="text" class="form-control" id="priority_number" name="priority_number" placeholder="例如:JP2013270967">
                        </div>
                    </li>
                    <!-- 11 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="ipc_number_option" id="select11">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="IPC分类号" disabled>
                            <input type="text" class="form-control" id="ipc_number" name="ipc_number" placeholder="例如:A61K">
                        </div>
                    </li>
                    <!-- 12 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="ipc_primary_number_option" id="select12">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="IPC主分类号" disabled>
                            <input type="text" class="form-control" id="ipc_primary_number" name="ipc_primary_number" placeholder="例如:A61K">
                        </div>
                    </li>
                    <!-- 13 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="cpc_number_option" id="select13">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="CPC分类号" disabled>
                            <input type="text" class="form-control" id="cpc_number" name="cpc_number" placeholder="例如:Y02B60/50">
                        </div>
                    </li>
                    <!-- 14 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="loc_number_option" id="select14">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="LOC分类号" disabled>
                            <input type="text" class="form-control" id="loc_number" name="loc_number" placeholder="例如:01-01">
                        </div>
                    </li>
                    <!-- 15 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="origin_name_option" id="select15">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="原始申请(专利权)人" disabled>
                            <input type="text" class="form-control" id="origin_name" name="origin_name" placeholder="例如:华为">
                        </div>
                    </li>
                    <!-- 16 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="present_name_option" id="select16">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="当前申请(专利权)人" disabled>
                            <input type="text" class="form-control" id="present_name" name="present_name" placeholder="例如:华为">
                        </div>
                    </li>


                    <!-- 17 -->
                    <!-- <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="origin_name_option" id="select17">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="原始申请(专利权)人" disabled>
                            <input type="text" class="form-control" id="origin_name" name="origin_name" placeholder="例如:华为">
                        </div>
                    </li> -->
                    <!-- ??? -->
                    <!-- 18 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="present_name_address_option" id="select18">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="当前申请(专利权)人地址" disabled>
                            <input type="text" class="form-control" id="present_name_address" name="present_name_address" placeholder="例如:北京朝阳区">
                        </div>
                    </li>
                    <!-- 19 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="invent_name_option" id="select19">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="发明人" disabled>
                            <input type="text" class="form-control" id="invent_name" name="invent_name" placeholder="例如:李书福">
                        </div>
                    </li>
                    <!-- 20 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="agent_name_option" id="select20">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="代理人" disabled>
                            <input type="text" class="form-control" id="agent_name" name="agent_name" placeholder="例如:吴乐观">
                        </div>
                    </li>
                    <!-- 21 -->
                    <li class=" field-item normal">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="agent_company_name_option" id="select21">
                                    <option value="AND">AND</option>
                                    <option value="OR">OR</option>
                                    <option value="NOT">NOT</option>
                                </select>
                            </div>
                            <input type="text" class="form-control col-3" placeholder="代理机构" disabled>
                            <input type="text" class="form-control" id="agent_company_name" name="agent_company_name" placeholder="例如:132465789">
                        </div>
                    </li>
                </ul>
            </form>
        </div>
        <div class="interval"></div>
        <div class="fixed-bottom">
            <div class="container">
                <!-- <h2>卡片头部和底部</h2> -->
                <div class="card bom">
                    <!-- <div class="card-header">头部</div> -->
                    <div class="card-body">
                        <div>
                            <span id="title_result"></span>
                            <!-- 1 -->
                            <span id="abstract_option"></span>
                            <span id="abstract_result"></span>

                            <!-- 2 -->
                            <span id="demands_option"></span>
                            <span id="demands_result"></span>

                            <!-- 3 -->
                            <span id="demand_option"></span>
                            <span id="demand_result"></span>

                            <!-- 4 -->
                            <span id="introduction_option"></span>
                            <span id="introduction_result"></span>

                            <!-- t5 -->
                            <span id="ask_begin_date_option"></span>
                            <span id="ask_begin_date_result"></span>
                            <span id="ask_over_date_result"></span>
                            <span id="ask_result"></span>


                            <!-- t6 -->
                            <span id="public_begin_date_option"></span>
                            <span id="public_begin_date_result"></span>
                            <span id="public_over_date_result"></span>
                            <span id="public_result"></span>

                            <!-- t7 -->
                            <span id="priority_begin_date_option"></span>
                            <span id="priority_begin_date_result"></span>
                            <span id="priority_over_date_result"></span>
                            <span id="priority_result"></span>

                            <!-- 8 -->
                            <span id="public_number_option"></span>
                            <span id="public_number_result"></span>

                            <!-- 9 -->
                            <span id="ask_number_option"></span>
                            <span id="ask_number_result"></span>

                            <!-- 10 -->
                            <span id="priority_number_option"></span>
                            <span id="priority_number_result"></span>

                            <!-- 11 -->
                            <span id="ipc_number_option"></span>
                            <span id="ipc_number_result"></span>

                            <!-- 12 -->
                            <span id="ipc_primary_number_option"></span>
                            <span id="ipc_primary_number_result"></span>

                            <!-- 13 -->
                            <span id="cpc_number_option"></span>
                            <span id="cpc_number_result"></span>

                            <!-- 14 -->
                            <span id="loc_number_option"></span>
                            <span id="loc_number_result"></span>

                            <!-- 15 -->
                            <span id="origin_name_option"></span>
                            <span id="origin_name_result"></span>

                            <!-- 16 -->
                            <span id="present_name_option"></span>
                            <span id="present_name_result"></span>

                            <!-- 17 --> 
                            <span id="origin_name_option"></span>
                            <span id="origin_name_result"></span>

                            <!-- 18 -->
                            <span id="present_name_address_option"></span>
                            <span id="present_name_address_result"></span>

                            <!-- 19 -->
                            <span id="invent_name_option"></span>
                            <span id="invent_name_result"></span>

                            <!-- 20 -->
                            <span id="agent_name_option"></span>
                            <span id="agent_name_result"></span>

                            <!-- 21 -->
                            <span id="agent_company_name_option"></span>
                            <span id="agent_company_name_result"></span>

                        </div>
                        <span id="mergeVal"></span>
                        <span id="mergeTimeVal"></span>
                    </div>
                    <div class="card-footer">
                        <!-- <button id="mergeOption">合并</button> -->
                        <!-- <button id="mergeOptionTime">时间合并</button> -->
                        <form action="/search_data" method="POST" class="form-inline">
                            {{ csrf_field() }}
                            <input type="hidden" id="submitVal" class="form-control search_data" type="text" name="transData" value="" placeholder="Search">
                            <button type="submit" id="searchBtn" class="btn btn-primary">开始搜索</button>
                        </form>
                        <button id="clears" class="btn btn-secondary">重置</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="js/patentSearch.js"></script>
</body>

</html>