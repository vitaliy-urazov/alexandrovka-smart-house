
import { useTemperature } from './useTemperature'
import { useHumidity } from './useHumidity'
import { useCO2 } from './useCO2'

export function useRoomInfo(value, roomName) {

    let res = {
        temp: Object,
        hum: Object,
        co2: Object,
    };
    res.temp = useTemperature(value.value[roomName][0])
    res.hum = useHumidity(value.value[roomName][1])
    res.co2 = useCO2(value.value[roomName][2])

    return res
}