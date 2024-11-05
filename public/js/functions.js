function formatCurrencyID(num) {
    num = (num / 100).toString();
    // console.log(num);
    // console.log(num.includes(","));
    // console.log(num.includes("."));
    if (num.includes(".")) {
        num = num.split(".");
        num[0] = parseFloat(num[0]).toLocaleString("id-ID", {style: "decimal",});
        num = `${num[0]},${num[1]}`
    } else {
        num = parseFloat(num).toLocaleString("id-ID", {style: "decimal",});
        num = `${num},-`;
    }

    return num;

    // let hidden_num;
    // if (num.length === 2) {
    //     if (num[1] !== "") {
    //         hidden_num = `${num[0]}.${num[1]}`;
    //     }
    // } else {
    //     hidden_num = num[0];
    // }

    // hidden_num = parseFloat(hidden_num);
    // document.getElementById(hidden_id).value = hidden_num;
    // if (!isNaN(hidden_num)) {
    //     let real_number_formatted = parseFloat(num[0]).toLocaleString("id-ID", {
    //         style: "decimal",
    //     });
    //     if (num.length === 2) {
    //         formatted.value = `${real_number_formatted},${num[1]}`;
    //     } else {
    //         formatted.value = real_number_formatted;
    //     }
    // }
}

const formatNumberDecID = (num) => {
    num = (num / 100).toString();
    if (num.includes(".")) {
        num = num.split(".");
        num[0] = parseFloat(num[0]).toLocaleString("id-ID", {style: "decimal",});
        num = `${num[0]},${num[1]}`
    } else {
        num = parseFloat(num).toLocaleString("id-ID", {style: "decimal",});
    }

    return num;
}

function formatCurrencyIDw100(num) {
    // console.log(num);
    num = num.toString();
    if (num.includes(".")) {
        num = num.split(".");
        num[0] = parseFloat(num[0]).toLocaleString("id-ID", {style: "decimal",});

        if (num[1] == '00') {
            num = `${num[0]},-`;
        } else if(num[1].length === 1) {
            num = `${num[0]},${num[1]}0`;
        } else {
            num = `${num[0]},${num[1]}`;
        }

    } else {
        num = parseFloat(num).toLocaleString("id-ID", {style: "decimal",});
        num = `${num},-`;
    }

    return num;
}

const formatNumberDecIDw100 = (num) => {
    num = num.toString();
    if (num.includes(".")) {
        num = num.split(".");
        num[0] = parseFloat(num[0]).toLocaleString("id-ID", {style: "decimal",});

        if (num[1] == '00') {
            num = `${num[0]}`;
        } else {
            num = `${num[0]},${num[1]}`;
        }
    } else {
        num = parseFloat(num).toLocaleString("id-ID", {style: "decimal",});
    }

    return num;
}

export{formatCurrencyID, formatNumberDecID, formatCurrencyIDw100, formatNumberDecIDw100};