 
var themes = [
        { label: 'Arctic', group: 'Themes', value: 'arctic' },
        { label: 'Web', group: 'Themes', value: 'web' },
        { label: 'Bootstrap', group: 'Themes', value: 'bootstrap' },
        { label: 'Metro', group: 'Themes', value: 'metro' },
        { label: 'Metro Dark', group: 'Themes', value: 'metrodark' },
        { label: 'Office', group: 'Themes', value: 'office' },
        { label: 'Orange', group: 'Themes', value: 'orange' },
        { label: 'Fresh', group: 'Themes', value: 'fresh' },
        { label: 'Energy Blue', group: 'Themes', value: 'energyblue' },
        { label: 'Dark Blue', group: 'Themes', value: 'darkblue' },
        { label: 'Black', group: 'Themes', value: 'black' },
        { label: 'Shiny Black', group: 'Themes', value: 'shinyblack' },
        { label: 'Classic', group: 'Themes', value: 'classic' },
        { label: 'Summer', group: 'Themes', value: 'summer' },
        { label: 'High Contrast', group: 'Themes', value: 'highcontrast' },
        { label: 'Lightness', group: 'UI Compatible', value: 'ui-lightness' },
        { label: 'Darkness', group: 'UI Compatible', value: 'ui-darkness' },
        { label: 'Smoothness', group: 'UI Compatible', value: 'ui-smoothness' },
        { label: 'Start', group: 'UI Compatible', value: 'ui-start' },
        { label: 'Redmond', group: 'UI Compatible', value: 'ui-redmond' },
        { label: 'Sunny', group: 'UI Compatible', value: 'ui-sunny' },
        { label: 'Overcast', group: 'UI Compatible', value: 'ui-overcast' },
        { label: 'Le Frog', group: 'UI Compatible', value: 'ui-le-frog' }
    ];
function initthemes() {
    
    var loadedThemes = [0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1];

    var me = this;
    //设置默认皮肤， 从cookie取值
    selectedTheme = $.jqx.cookie.cookie('shinTheme');
    if (!selectedTheme) {
        selectedTheme = 'ui-sunny'; 
    }
    var themeIndex = 0;
    $.each(themes, function (index) {
        if (this.value == selectedTheme) {
            themeIndex = index;
            return false;
        }
    });
    $('#themeComboBox').jqxDropDownList({ displayMember: "label", valueMember: "value", source: themes,
        theme: selectedTheme, dropDownHeight: 200, width: '140px', height: '20px', selectedIndex: themeIndex
    });
    loadedThemes[0] = -1;
    loadedThemes[themeIndex] = 0;

    $('#themeComboBox').on('select', function (event) {
        setTimeout(function () {
            var selectedIndex = event.args.index;
            var selectedTheme = '';
            var loaded = loadedThemes[selectedIndex] != -1;
            loadedThemes[selectedIndex] = selectedIndex;
            selectedTheme = themes[selectedIndex].value;
            $.jqx.cookie.cookie('shinTheme', selectedTheme); 
            location.reload();
        }, 5);
    });
    createLinkSkin(selectedTheme);
    $.jqx.theme = selectedTheme  ;
};


function createLinkSkin(skinName) {
    var basecss = $("#basecss");
    var skinlink = basecss.attr("href");
    if (!skinlink) {
    } else {
        var searchchar = "styles/jqx.";
        var start = skinlink.indexOf(searchchar);
        var newskinlink = skinlink.substring(0, start + searchchar.length);
        newskinlink += skinName + ".css";
        $("#basecss").after("<link rel='stylesheet'   href='" + newskinlink + "' type='text/css' />") 
       
        $.jqx.theme = skinName; 
        
    }

}

function SetTheme() {

    $.jqx.theme = $.jqx.cookie.cookie('shinTheme');
    if (!$.jqx.theme) {
        $.jqx.theme = 'ui-sunny';
        $.jqx.cookie.cookie('shinTheme', $.jqx.theme); 
    }
       createLinkSkin($.jqx.theme);
    }

 
