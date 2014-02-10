function getPercent(percet, parent ) {
    if (jQuery.isNumeric(percet)) {
        return percet;
    } else {
            var real =   parent.height()-18;
            percet = $.trim(percet);
            percet = percet.substring(0, percet.length - 1);
            real = real * percet / 100;
            return real ;
        }


    }
/*添加注释3*/