<template>
    <div class="container">
        <div class="">
            <!-- <field-component></field-component> -->
            <div :id="'veiculo-'+vehicle.id">
                <div style="font-weight: bold;font-size: 1.3rem;" class="car-ident">
                    <span>{{ vehicle.brand }}</span>
                    <span>{{ vehicle.model }}</span>
                </div>
                <div>
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['vehicle'],
        data(){
            return{
                'fields':
                [
                    {'ele':{'type':'h5'}},
                    {'brand':{'ele':'h1'}}
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
