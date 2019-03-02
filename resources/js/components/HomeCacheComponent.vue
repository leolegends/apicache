<template>
    
        <div class="container search-form">
            <h1 class="text-white">Quarks<b>Cache</b></h1>
            <div class="row mt-3">
                <div class="col-md-12">

                    <div class="search-box text-white">
                        
                            <label for="">Endpoint</label>
                        <div class="input-group mb-3">
                                <input type="text" v-model="endpoint_input" class="form-control" placeholder="Entre com a URL da API e Pronto!" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-success" @click="generateCache()" type="button">Cachear</button>
                                </div>
                        </div>
                                  
                    </div>
                    
                </div>
            </div>
            <div class="row text-white">
                    
                    <div class="col-md-12 align-self-center">
                            <label for="">Headers</label>
                            <div id="headers" v-for="(line, key) in lines">
                                <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Key and Value</span>
                                        </div>
                                        <input type="text" v-model="values[key]" class="form-control">
                                        <input type="text" v-model="keys[key]" class="form-control">
                                        <div class="input-group-append">
                                            <td>
                                                <button class="btn btn-danger" @click="removeHeader(key)" type="button">X</button>
                                            </td>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <button @click="addLineHeader()" class="btn btn-primary text-center">New Key</button>
                </div>
            </div>
        </div>
            
</template>


<script>
export default {
    props: {
        'url': ''
    },
    data() {
        return {
            a: 1,
            endpoint: this.url,
            lines: ['1'],
            values: [],
            keys: [],
            endpoint_input: ''
        }
    },
    methods: {

        generateCache: function() {
            
            console.log(this.keys);

            window.axios.post(this.endpoint, {
                    "url": url
            }).fetch((data) => {
                return data.url;
            });
        },
        removeHeader: function(key){
             this.lines.splice(key, 1);
        },
        addLineHeader: function(){
            this.lines.push(1);
        }
    },
    mounted(){
        // console.log(this.values);
        console.log("Hello!");
    }
}
</script>
