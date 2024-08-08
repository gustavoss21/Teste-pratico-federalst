<template>
    <div class="container">
        
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
                axios.get(href)
                    .then(
                        response => {
                            console.log(response)
                        }
                    )
                    .catch(error => {
                            this.message_alert('danger','hover um erro inesperado')
                            console.log(error)
                        }
                    )
            },
        },
        
        mounted() {
            this.get_list_car()
        }
    }
</script>
