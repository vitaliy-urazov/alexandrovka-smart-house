import { ref } from 'vue'

export function useHumidity(value) {
    // state encapsulated and managed by the composable
    let val = 0
    let level = 0

    val = parseInt(value);
    let tmp = val;

    // good
    if (tmp >= 40 && tmp <= 60){
        level = 1;
    }
    // warning
    else if ( (tmp >= 20 && tmp < 40) || (tmp > 60 && tmp <= 70) ){
        level = 2;
    }
    // danger
    else if ( tmp < 20 || tmp > 70 ){
        level = 3;
    }

    // expose managed state as return value
    return { val, level }
}