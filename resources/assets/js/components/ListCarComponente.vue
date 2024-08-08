<template>
    <div class="container">
        <h1></h1>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                urlBasy:window.location.origin
            }
        },
        methods:{
            get_list_car(){
                let href = this.urlBasy + '/api/veiculo'
                console.log([])
                axios.get(href,{
                    headers: {
                        'Authorization': 'Bearer ' + this.getCookie('token')
                    }}
                )
                
                //     .then(
                //         response => {
                //             console.log(response)
                //         }
                //     )
                //     .catch(error => {
                //             this.message_alert('danger','hover um erro inesperado')
                //             console.log(error)
                //         }
                //     )
            },

            getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }
        },
        
        mounted() {
            this.get_list_car()
        }
    }
</script>
