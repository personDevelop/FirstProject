var Msg = {
    errorWindow: "<div id='errorWindow'> <div id='title'> <img width='14'   height='14' src='../../script/img/close.png' alt='' /> 错误</div> <div><div id='errormsg'></div><div><div style='float: right; margin-top: 15px;'><input type='button' id='ok' value='确定' style='margin-right: 10px' /></div></div></div></div>",
    querryWindow: " <div id='querryWindow'><div><img width='14'height='14'src='../../script/img/help.png'alt=''/>询问信息</div><div><div id='querrymsg'></div><div><div style='float: right; margin-top: 15px;'><input type='button'id='querryok'value='是'style='margin-right: 10px'/><input type='button'id='querrycancel'value='否'/></div></div></div></div>",
    successWindow: "<div id='successWindow'> <div id='title'> <img width='14'   height='14' src='../../script/img/arrowdown.gif' alt='' />操作成功</div> <div><div id='successmsg'></div><div><div style='float: right; margin-top: 15px;'><input type='button' id='successok' value='确定' style='margin-right: 10px' /></div></div></div></div>",
    ShowError: function (msg, title) {


        var errormsg = $("#errorWindow").find("#errormsg")
        errormsg.html(msg);
        $("#errorWindow").jqxWindow('open');
    },
    ShowSuccess: function (msg) {
        var errormsg = $("#successWindow").find("#successmsg")
        errormsg.html(msg);
        $("#successWindow").jqxWindow('open');
    },
    Query: function (msg, callFunc) {
        var querrymsg = $("#querryWindow").find("#querrymsg")
        querrymsg.html(msg);
        $('#querryok').jqxButton().on("click", callFunc);
        $("#querryWindow").jqxWindow('open');
    },
    ShowInfo: function () { },
    innit: function () {
        errorWindow = this.errorWindow;
        querryWindow = this.querryWindow;
        successWindow = this.successWindow;
        $(function () {
            $("body").after(errorWindow).after(querryWindow).after(successWindow);
            $("#errorWindow").jqxWindow({ maxHeight: 150, maxWidth: 280, minHeight: 30, minWidth: 250, height: 145, width: 270,
                resizable: false, autoOpen: false, isModal: true, modalOpacity: 0.3,
                okButton: $('#ok'),
                initContent: function () {
                    $('#ok').jqxButton({ width: '65px' });
                    $('#ok').focus();
                }
            });


            $("#querryWindow").jqxWindow({ maxHeight: 150, maxWidth: 280, minHeight: 30, minWidth: 250, height: 145, width: 270,
                resizable: false, autoOpen: false, isModal: true, modalOpacity: 0.3,
                okButton: $('#querryok'), cancelButton: $('#querrycancel'),
                initContent: function () {
                    $('#querryok').jqxButton({ width: '65px' });
                    $('#querrycancel').jqxButton({ width: '65px' });
                    $('#querryok').focus();
                }
            });

            $("#successWindow").jqxWindow({ maxHeight: 150, maxWidth: 280, minHeight: 30, minWidth: 250, height: 145, width: 270,
                resizable: false, autoOpen: false, isModal: false, modalOpacity: 0.3,
                okButton: $('#successok'),
                initContent: function () {
                    $('#successok').jqxButton({ width: '65px' }); 
                    $('#successok').focus();
                }
            });
        });
    }
};
Msg.innit();
 