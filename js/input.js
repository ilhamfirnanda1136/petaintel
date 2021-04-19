function capitalize_Words(str) {
    return str.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

function loading() {
    $('#loader').show();
    $('.div-loading').addClass('background-load');
}

function matikanLoading() {
    $('#loader').hide();
    $('.div-loading').removeClass('background-load');
}

  function hapusvalidasi(key, edit = false) {
      let pesan = edit === true ? $('#edit_' + key) : $('#' + key);
      let text = edit === true ? $('.edit_' + key) : $('.' + key);
      pesan.removeClass('is-invalid');
      text.text(null);
  }

function isEmpty(obj) {
  return Object.keys(obj).length === 0;
}

function randomColor() {
    const hex = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "A", "B", "C", "D", "E", "F"];
     let hexColor = "#";
     for (let i = 0; i < 6; i++) {
         hexColor += hex[Math.floor(Math.random() * hex.length)];
     }
     return hexColor;
}



 function getColor(d) {
    return d == 'Boalemo' ? '#831083' :
           d == 'Bone Bolango' ? '#F86910' :
           d == 'Danau Limboto' ? '#628EE4' :
           d == 'Gorontalo' ? '#B680D8' :
           d == 'Gorontalo Utara' ? '#EE79F3' :
           d == 'Kota Gorontalo' ? '#0F84B5' :
           d == 'Pohuwato' ? '#49582D' :
           d == 'Mukomuko' ? '#AC3221' : '#8C39DC';
  }

function wordWrap(str, maxWidth) {
    var newLineStr = "<br>";
    done = false;
    res = '';
    while (str.length > maxWidth) {
        found = false;
        // Inserts new line at first whitespace of the line
        for (i = maxWidth - 1; i >= 0; i--) {
            console.log(i);
            if (testWhite(str.charAt(i))) {
                res = res + [str.slice(0, i), newLineStr].join('');
                str = str.slice(i + 1);
                found = true;
                break;
            }
        }
        // Inserts new line at maxWidth position, the word is too long to wrap
        if (!found) {
            res += [str.slice(0, maxWidth), newLineStr].join('');
            str = str.slice(maxWidth);
        }

    }
    return res + str;
}

function testWhite(x) {
    var white = new RegExp(/^\s$/);
    return white.test(x.charAt(0));
}