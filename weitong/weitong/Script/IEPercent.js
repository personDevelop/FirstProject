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
/*Ìí¼Ó×¢ÊÍ*/