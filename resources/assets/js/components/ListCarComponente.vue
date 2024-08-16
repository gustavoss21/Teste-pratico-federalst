<template>
    <div class="content" style="margin-left:5%;">
     <div style="display: flex;    align-items: center;">
        <h1 style="margin-right: 5px;">sua lista de carro</h1>
        <a :href="url_origin +'/admin/home/veiculo/adicionar'">
            <span style="font-weight: 600;color: #e4e403;" class="material-symbols-outlined">add_box</span>
        </a>
     </div>   
    <h1 v-bind="message_atribute" id="message">{{ message }}</h1>

    <div>
        <car-component></car-component>
    </div>
    </div>
    
</template>

<script>
    export default {
        data(){
            return {
                url_origin:window.location.origin,
                'message_atribute':{'style':{'display':'none','color':'red'}},
                'message':'',
                }
            
        },
        methods:{
          
        },
      
        mounted() {
        }
    }
</script>
