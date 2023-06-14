import { ref } from 'vue'

export function useTemperature(value) {
    // state encapsulated and managed by the composable
    let val = '0'
    let level = 0

    val = parseFloat(value).toFixed(1);
    let tmp = parseInt(value);

    // good
    if (tmp >= 18 && tmp <= 26){
        level = 1;
    }
    // warning
    else if ( (tmp >= 10 && tmp < 18) || (tmp > 26 && tmp <= 33) ){
        level = 2;
    }
    // danger
    else if ( tmp < 10 || tmp > 33 ){
        level = 3;
    }

    // expose managed state as return value
    return { val, level }
}