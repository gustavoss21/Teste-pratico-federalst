<template>
<div  v-bind="div_parent">
    <div v-bind="div_content" v-for="vehicle in vehicles" :key="vehicle.id">
    <div class="container">
        <div class="">
            <!-- <field-component></field-component> -->
            <div :id="'veiculo-'+vehicle.id">
                <div v-bind="car_ident">
                    <span>{{ vehicle.brand }}</span>
                    <span>{{ vehicle.model }}</span>
                </div>
                <div v-bind="adjust_child">
                    <div>
                        <span style="font-weight: bolder;">id do veiculo:</span> 
                        <span>{{ vehicle.id }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bolder;">placa:</span> 
                        <span>{{ vehicle.plate }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bolder;">ano:</span>
                        <span>{{ vehicle.year }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bolder;">ultima atualização:</span>
                        <span>{{ vehicle.updated_at }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bolder;">proprietario:</span>
                        <span>{{ vehicle.user_id }}</span>
                    </div>
                    <div class="action-vehicle">
                        <div>
                            <a :href="url_origin +'/admin/home/veiculo/delete/'+vehicle.id">
                                <span style="color: red;" class="material-symbols-outlined">delete</span>
                            </a>
                        </div>
                        <div>
                            <a :href="url_origin +'/admin/home/veiculo/atualizar/'+vehicle.id">
                                <span  style="color: blue;" class="material-symbols-outlined">edit</span>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</template>

<script>
    export default {
        props:['data'],
        data(){
            return{
                url_origin:window.location.origin,
                vehicles:[],
                div_parent:{
                    style:"display: flex; flex-wrap: wrap; gap: 20px;"
                },
                div_content:{
                    class:"content-vehicle"
                },
                car_ident:{
                    style:"text-align:center; font-size:1.4rem; margin-bottom: 15px"
                },
                adjust_child:{}

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
                    return this.url_origin + '/admin/get-veiculos'
                }

                return this.url_origin + '/get-veiculos'
            },

            setStyleTemplate(){
                this.div_parent.style = 'font-size:1.2rem'
                this.div_content.class = ''
                this.adjust_child.class = 'adjust-space-childrens'
                this.car_ident.style = 'font-size: 3rem;margin-bottom: 30px;'
            }
        },
        mounted() {
            if(this.data){
                this.vehicles = [(JSON.parse(this.data))]
                return this.setStyleTemplate()

            }

            this.getVehicles()
        }, 
    }
</script>
