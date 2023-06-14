import { ref } from 'vue'

export function useCO2(value) {
    if (!value) return null;


    // state encapsulated and managed by the composable
    let val = 0
    let level = 0

    val = parseInt(value)
    let tmp = val

    // good
    if ( tmp <= 1000){
        level = 1;
    }
    // warning
    else if ( tmp >= 1000 && tmp <= 2000 ){
        level = 2;
    }
    // danger
    else if ( tmp > 2000 ){
        level = 3;
    }

    // expose managed state as return value
    return { val, level }
}