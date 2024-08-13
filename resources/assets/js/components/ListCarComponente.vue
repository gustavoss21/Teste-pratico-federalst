<template>
    <div class="content" style="margin-left:5%;">
        
    <h1>sua lista de carro</h1>
    <h1 v-bind="message_atribute" id="message">{{ message }}</h1>

    <div class="" style="display: flex; flex-wrap: wrap;">
    <div class="conten-vehicle" style="padding: 10px; flex: 0 0 400px; margin-bottom: 20px;" v-for="vehicle in vehicles" :key="vehicle.id">
        <car-component :vehicle="vehicle"></car-component>
    </div>
    </div>
    </div>
    
</template>

<script>
    export default {
        data(){
            return {
                urlBasy:window.location.origin,
                vehicles:[],
                'message_atribute':{'style':{'display':'none','color':'red'}},
                'message':'',
                }
            
        },
        methods:{
            getVehicles(){
                let href = this.getUrl()
                axios.get(href)
                    .then(
                        response => {
                            this.vehicles = response.data['data'] ?? response.data                           
                            console.log(this.vehicles)
                        }
                    )
                    .catch(error => {
                            console.log(Object.keys(error))
                            let message_error = error.response.data.message
                            this.message_atribute.style.display = 'block';
                            this.message = 'Error: '+ message_error

                        }
                    )
            },

            getUrl(){                
                if(location.href.search('admin') != -1){
                    return this.urlBasy + '/admin/get-veiculos'
                }

                return this.urlBasy + '/get-veiculos'
            },
        },
        
        mounted() {
            this.getVehicles()
        }
    }
</script>
