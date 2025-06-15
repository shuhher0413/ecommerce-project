    <!-- 將資料庫連線程式載入 -->
    <?php require_once("Connections/conn_db.php"); ?>
    <!-- 如果SESSION沒有啟動，則啟動SESSION功能，這是跨網頁變數存取 -->
    <?php (!isset($_SESSION)) ? session_start() : ""; ?>
    <!-- 載入共用PHP函數庫 -->
    <?php require_once("php_lib.php"); ?>
    <?php
    //建立強制使用者登入，才能結帳
    if (!isset($_SESSION['login'])) {
        $sPath = "login.php?sPath=profile";
        header(sprintf("Location: %s", $sPath));
    }
    ?>
    <!doctype html>
    <html lang="zh-TW">

    <head>
        <!-- 引入網頁標頭 -->
        <?php include_once("headfile.php"); ?>
        <style type="text/css">
            .input-group>.form-control {
                width: 100%;
            }

            span.error-tips,
            span.error-tips::before {
                font-family: "Font Awesome 5 Free";
                color: red;
                font-weight: 900;
                content: "\f0c4";
            }

            span.valid-tips,
            span.valid-tips::before {
                font-family: "Font Awesome 5 Free";
                color: greenyellow;
                font-weight: 900;
                content: "\f00c";
            }
        </style>
    </head>

    <body>
        <section id="header">
            <!--引入導覽列-->
            <?php include_once("navbar.php"); ?>
        </section>
        <section id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <!--引入sidebar分類導覽-->
                        <?php include_once("sidebar.php"); ?>
                        <!--引入熱銷商品查詢-->
                        <?php include_once("hot.php"); ?>
                    </div>
                    <div class="col-md-10">
                        <!-- 會員註冊頁面 -->
                   <?php include_once("profile_content.php") ?>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <hr>
                <section id="footer">
            <!-- 聯絡資訊 -->
            <?php include_once("footer.php"); ?>
        </section>
        <?php include_once("jsfile.php"); ?>
        <script type="text/javascript" src="commlib.js"></script>
        <script type="text/javascript" src="./jquery.validate.js"></script>
        <script src="https://unpkg.com/vue@3"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script type="text/javascript">
            const Vue3 = Vue.createApp({
                data() {
                    return {
                        emailid: <?php echo $_SESSION['emailid'] ?>, //取得會員emailid
                        member: [], //會員資料更新陣列
                        captcha: '', //存認證碼變數
                        readonly: true, //資料讀取模式或是編輯模式
                        PWOld: '', //密碼更改存舊密碼變數
                        PWNew1: '', //密碼更改新密碼變數1
                        PWNew2: '', //密碼更改新密碼變數2
                    }
                },
                methods: {
                    //存修改後的密碼至後台資料庫
                    async savePW() {
                        let valid = $('#changePW').valid(); //呼叫資料驗證函數
                        if (valid) {
                            await axios.get('reqchangePW.php', {
                                    params: {
                                        emailid: this.member.emailid,
                                        PWNew1: MD5(this.PWNew1),
                                    }
                                })
                                .then((res) => {
                                    let data = res.data;
                                    if (data.c == true) {
                                        $('#changePW').validate().resetForm();
                                        this.PWOld = '';
                                        this.PWNew1 = '';
                                        this.PWNew2 = '';
                                        $('#mClose').click();
                                        alert(data.m);
                                    }
                                })
                                .catch(function(error) {
                                    alert(error);
                                });
                        }
                    },
                    //存修改後的會員資料至後台資料庫
                    async saveMember() {
                        let valid = $('#reg').valid(); //呼叫資料驗證函數
                        if (valid) {
                            let imgfile = $('#uploadname').val();
                            if (imgfile != '') {
                                this.member.imgname = imgfile;
                            }
                            await axios.get('reqMember.php', {
                                    params: {
                                        birthday: this.member.birthday,
                                        cname: this.member.cname,
                                        emailid: this.member.emailid,
                                        tssn: this.member.tssn,
                                        imgname: this.member.imgname,
                                    }
                                })
                                .then((res) => {
                                    let data = res.data;
                                    if (data.c == true) {
                                        alert(data.m);
                                        location.reload();
                                    }
                                })
                                .catch(function(error) {
                                    alert(error);
                                });
                        }
                    },
                    //開啟編輯模式
                    editMember() {
                        this.readonly = false;
                    },
                    //使用第三方AJAX的API,取得使用者資料
                    getMemberInfo() {
                        axios.get('memberinfo.php', {
                                params: {
                                    emailid: this.emailid,
                                }
                            })
                            .then((res) => {
                                let data = res.data;
                                if (data.c == true) {
                                    this.member = data.d[0];
                                } else {
                                    alert(data.m);
                                }
                            })
                            .catch(function(error) {
                                alert("系統目前無法連接到後台資料庫");
                            });
                    },
                    getCaptcha() {
                        //can為canvas的id名稱
                        //150=影像寬，50=影像高,blue=影像背景顏色
                        //white=文字顏色，28px=文字大小，5=認證碼長度
                        this.captcha = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
                    },
                },
                mounted() {
                    this.getCaptcha();
                    this.getMemberInfo();
                },
            });
            Vue3.mount("#modify");
        </script>
        <script type="text/javascript">
            // 自訂身份證格式驗證
            jQuery.validator.addMethod("tssn", function(value, element, param) {
                var tssn = /^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$/;
                return this.optional(element) || (tssn.test(value));
            });
            //驗證form #reg表單
            $("#reg").validate({
                rules: {
                    cname: {
                        required: true
                    },
                    tssn: {
                        required: true,
                        tssn: true,
                    },
                    birthday: {
                        required: true,

                    },
                    recaptcha: {
                        required: true,
                        equalTo: "#captcha",
                    },
                },
                messages: {
                    cname: {
                        required: '使用者名稱不得為空白',
                    },
                    tssn: {
                        required: '使用者身分證字號不得為空白',
                        tssn: '身分證ID格式有誤',
                    },
                    birthday: {
                        required: '生日不得為空白',
                    },
                    recaptcha: {
                        required: '驗證碼不得為空白',
                        equalTo: '驗證碼需相同！！',
                    },
                },
            });
            //驗證changePW變更密碼表單
            $("#changePW").validate({
                rules: {
                    PWOld: {
                        required: true,
                        remote: 'checkPW.php?emailid=<?php echo $_SESSION['emailid'] ?>'
                    },
                    PWNew1: {
                        required: true,
                        maxlength: 20,
                        minlength: 4,
                    },
                    PWNew2: {
                        required: true,
                        equalTo: '#PWNew1'
                    },
                },
                messages: {
                    PWOld: {
                        required: '使用者名稱不得為空白',
                        remote: '原始密碼有錯誤，需重新輸入'
                    },
                    PWNew1: {
                        required: '密碼不得為空白',
                        maxlength: '密碼最大長度為20位(4-20位英文字母與數字組合)',
                        minlength: '密碼最小長度為4位(4-20位英文字母與數字組合)',
                    },
                    PWNew2: {
                        required: '確認密碼不得為空白',
                        equalTo: '兩次輸入的密碼必須一致！',
                    },
                },
            });
            //取得元素ID
            function getId(el) {
                return document.getElementById(el);
            }
            //圖示上傳處理
            $("#uploadForm").click(function(e) {
                var fileName = $('#fileToUpload').val();
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
                    $('#progress-div01').css("display", "flex");
                    let file1 = getId("fileToUpload").files[0];
                    let formdata = new FormData();
                    formdata.append("file1", file1);
                    let ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.addEventListener("load", completeHandler, false);
                    ajax.addEventListener("error", errorHandler, false);
                    ajax.addEventListener("abort", abortHandler, false);
                    ajax.open("POST", "file_upload_parser.php");
                    ajax.send(formdata);
                } else {
                    alert('目前只支援jpg、jpeg、png、gif檔案格式上傳');
                }
            });
            //上傳過程顯示百分比
            function progressHandler(event) {
                let percent = Math.round((event.loaded / event.total) * 100);
                $("#progress-bar01").css("width", percent + "%");
                $("#progress-bar01").html(percent + "%");
            }
            //上傳完成處理顯示圖片
            function completeHandler(event) {
                let data = JSON.parse(event.target.responseText);
                if (data.success == 'true') {
                    $('#uploadname').val(data.fileName);
                    $('#showimg').attr({
                        'src': 'uploads/' + data.fileName,
                        'style': 'display:block;'
                    });
                    $('button.btn.btn-danger').attr({
                        'style': 'display:none;'
                    });
                } else {
                    alert(data.error);
                }
            }
            //Upload Failed:上傳發生錯誤處理
            function errorHandler(event) {
                alert('Upload Failed:上傳發生錯誤');
            }
            //Upload Aborted:上傳作業取消處理
            function abortHandler(event) {
                alert('Upload Aborted:上傳作業取消');
            }
        </script>

    </body>
    <?php


    ?>

    </html>