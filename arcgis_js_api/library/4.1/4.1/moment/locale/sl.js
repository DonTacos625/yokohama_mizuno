//>>built
(function(e,a){"object"===typeof exports&&"undefined"!==typeof module&&"function"===typeof require?a(require("../moment")):"function"===typeof define&&define.amd?define(["../moment"],a):a(e.moment)})(this,function(e){function a(a,b,e,d){var c=a+" ";switch(e){case "s":return b||d?"nekaj sekund":"nekaj sekundami";case "m":return b?"ena minuta":"eno minuto";case "mm":return 1===a?c+(b?"minuta":"minuto"):2===a?c+(b||d?"minuti":"minutama"):5>a?c+(b||d?"minute":"minutami"):c+(b||d?"minut":"minutami");case "h":return b?
"ena ura":"eno uro";case "hh":return c=1===a?c+(b?"ura":"uro"):2===a?c+(b||d?"uri":"urama"):5>a?c+(b||d?"ure":"urami"):c+(b||d?"ur":"urami");case "d":return b||d?"en dan":"enim dnem";case "dd":return c=1===a?c+(b||d?"dan":"dnem"):2===a?c+(b||d?"dni":"dnevoma"):c+(b||d?"dni":"dnevi");case "M":return b||d?"en mesec":"enim mesecem";case "MM":return c=1===a?c+(b||d?"mesec":"mesecem"):2===a?c+(b||d?"meseca":"mesecema"):5>a?c+(b||d?"mesece":"meseci"):c+(b||d?"mesecev":"meseci");case "y":return b||d?"eno leto":
"enim letom";case "yy":return c=1===a?c+(b||d?"leto":"letom"):2===a?c+(b||d?"leti":"letoma"):5>a?c+(b||d?"leta":"leti"):c+(b||d?"let":"leti")}}return e.defineLocale("sl",{months:"januar februar marec april maj junij julij avgust september oktober november december".split(" "),monthsShort:"jan. feb. mar. apr. maj. jun. jul. avg. sep. okt. nov. dec.".split(" "),monthsParseExact:!0,weekdays:"nedelja ponedeljek torek sreda \u010detrtek petek sobota".split(" "),weekdaysShort:"ned. pon. tor. sre. \u010det. pet. sob.".split(" "),
weekdaysMin:"ne po to sr \u010de pe so".split(" "),weekdaysParseExact:!0,longDateFormat:{LT:"H:mm",LTS:"H:mm:ss",L:"DD. MM. YYYY",LL:"D. MMMM YYYY",LLL:"D. MMMM YYYY H:mm",LLLL:"dddd, D. MMMM YYYY H:mm"},calendar:{sameDay:"[danes ob] LT",nextDay:"[jutri ob] LT",nextWeek:function(){switch(this.day()){case 0:return"[v] [nedeljo] [ob] LT";case 3:return"[v] [sredo] [ob] LT";case 6:return"[v] [soboto] [ob] LT";case 1:case 2:case 4:case 5:return"[v] dddd [ob] LT"}},lastDay:"[v\u010deraj ob] LT",lastWeek:function(){switch(this.day()){case 0:return"[prej\u0161njo] [nedeljo] [ob] LT";
case 3:return"[prej\u0161njo] [sredo] [ob] LT";case 6:return"[prej\u0161njo] [soboto] [ob] LT";case 1:case 2:case 4:case 5:return"[prej\u0161nji] dddd [ob] LT"}},sameElse:"L"},relativeTime:{future:"\u010dez %s",past:"pred %s",s:a,m:a,mm:a,h:a,hh:a,d:a,dd:a,M:a,MM:a,y:a,yy:a},ordinalParse:/\d{1,2}\./,ordinal:"%d.",week:{dow:1,doy:7}})});