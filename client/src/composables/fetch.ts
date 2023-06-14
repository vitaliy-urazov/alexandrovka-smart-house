import { ref } from 'vue'

export async function useFetch(url) {
    console.log(url)
    const data = ref(null)
    const error = ref(null)


    let json;

    try {
        const response = await fetch(url);
        json = await response.json();
    } catch (err) {
        if (err instanceof SyntaxError) {
            // Unexpected token < in JSON
            console.log('There was a SyntaxError', err);
        } else {
            console.log('There was an error', err);
            error.value = err;
        }
    }

    if (json){
        data.value = json;
    }

    return {data, error}
}