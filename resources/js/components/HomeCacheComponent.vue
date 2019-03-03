<template>
    
        <div class="container search-form">
            <h1 class="text-white"><b>Quarks</b>Cache</h1>
            <p class="text-white">Os endpoints cacheados são expirados em 2 horas.</p>

            <div class="row mt-3">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Method</label>
                </div>
                <select class="custom-select" v-model="method_select">
                    <option value="method" v-for="method in http_methods" :value="method">{{method}}</option>
                </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="search-box text-white">
                        
                            <label for="">Endpoint</label>
                        <div class="input-group mb-3">
                                <input type="text" v-model="endpoint_input" id="endpoint_input" class="form-control" placeholder="Entre com a URL da API e Pronto!" aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success" @click="generateCache()">Cachear</button>
                                </div>
                        </div>
                                  
                    </div>
                    
                </div>
            </div>
            <div class="row text-white">
                    <div class="col-md-12 align-s
                    elf-center">
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

            <div class="row mt-4" id="url">
                <div class="col-md-12">
                    <label for="" class="text-white">URL Cacheada</label>
                    <div class="alert alert-success" role="alert">
                        {{link_cache}}
                    </div>  
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
            endpoint_input: '',
            http_methods: [
                'GET',
                'POST',
                'PUT',
                'DELETE'
            ],
            method_select: "GET",
            link_cache: "Seja um Quark =D"
        }
    },
    methods: {

        generateCache: function() {
            
            if(this.endpoint_input == ""){
                document.getElementById("endpoint_input").focus();
                alert("O Campo endpoint deve ser preenchido.");
                return;
            }

         //   this.link_cache = "www.test.com.br";

            window.axios.post(this.endpoint, {
                    "url": this.endpoint_input,
                    "method": this.method_select,
                    "header": this.keys,
                    "value": this.values
            }).then(({data}) => {
                console.log(data);
                this.link_cache = data.url;
            }).catch((data) => {
                this.link_cache = "Algo deu errado, verifique os parametros de entrada."
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
