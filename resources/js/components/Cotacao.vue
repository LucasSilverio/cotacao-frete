<template>
    <div class="container">
        <div class="row justify-content-center m-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Cadastro cotação de frete</div> 
                    <div class="card-body">
                        <alert-component tipo="success" :mensagem="requisicaoMsg"  v-if="requisicaoStatus == 'sucesso'"></alert-component>                   
                        <alert-component tipo="danger" :mensagem="requisicaoMsg" v-if="requisicaoStatus == 'erro'"></alert-component>
                    </div>
                    <div class="card-body">
                        <label>Transportadora</label>
                        <select v-model="trasportadoraSelecionada"  class="form-control mb-3" id="transportadora" >
                            <option value="" disabled selected>Transportadora</option>
                            <option v-for="transportadora in transportadoras" :value="transportadora.id">{{transportadora.nome}}</option>
                        </select>

                        <label>UF</label>
                        <select v-model="uf" class="form-control mb-3" id="uf">
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <label>Percentual de Cotação (%)</label>
                        <input type="number" v-model="percentual" class="form-control mb-3" id="percentual"/>
                        <label>Valor Extra (R$)</label>
                        <input type="text" v-model="valorExtra" class="form-control mb-3" id="valorExtra"/>
                        <button class="form-control btn-primary mb-3" @click="salvar()">Salvar</button>
                    </div>
                    <!-- Selected: {{trasportadoraSelecionada}} -->
                    
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Cotar Frete</div>
                    <div class="card-body">
                        <alert-component tipo="success" :mensagem="requisicaoMsg"  v-if="requisicaoStatus == 'sucessoCalculo'"></alert-component>                   
                        <alert-component tipo="danger" :mensagem="requisicaoMsg" v-if="requisicaoStatus == 'erroCalculo'"></alert-component>
                    </div>
                    <div class="card-body">
                        <label>UF</label>
                        <select v-model="ufCotacao" class="form-control mb-3">
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <label>Valor do Pedido (R$)</label>
                        <input type="text" v-model="valorPedido" class="form-control mb-3"/>
                        <button class="form-control btn-primary mb-3" @click="cotar()">Cotar</button>
                        <p>Melhores resultados:</p>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Rank</th>
                                <th scope="col">Transportadora</th>
                                <th scope="col">Valor Cotação</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr v-for="resultado in resultados" :key="resultado.transportadora">
                                        <th scope="row">{{resultado.rank}}</th>
                                        <td>{{resultado.transportadora}}</td>
                                        <td>{{"R$"+resultado.preco.toFixed(2)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center m-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Impostos Cadastrados</div> 
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">UF</th>
                        <th scope="col">Percentual Frete</th>
                        <th scope="col">Valor Taxa</th>
                        <th scope="col">Transportadora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="imposto in impostos" :key="imposto.id">
                            <th scope="row">{{imposto.id}}</th>
                            <td>{{imposto.uf}}</td>
                            <td>{{imposto.percentual_cotacao+"%"}}</td>
                            <td>{{"R$"+imposto.valor_extra}}</td>
                            <td>{{imposto.transportadora_id}}</td>
                        </tr>
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default{
        data(){
            return {
                urlBase: 'http://localhost:8000/api/cotacao',
                transportadoras:null,
                trasportadoraSelecionada:null,
                uf:null,
                percentual:null,
                valorExtra:null,
                ufCotacao:null,
                valorPedido:null,
                resultados:null,
                rank:0,
                impostos:null,
                requisicaoStatus:null,
                requisicaoMsg:null
            }
        },
        methods:{
            getTransportadoras(){
                fetch("http://localhost:8000/api/transportadora").then(response => response.json()).then(response => {
                    this.transportadoras = response;
                })
            },

            getImpostos(){
                fetch("http://localhost:8000/api/cotacao").then(response => response.json()).then(response => {
                    this.impostos = response;
                })
            },

            salvar(){
                let formData = new FormData();
                formData.append('uf', this.uf)
                formData.append('percentual_cotacao', this.percentual)
                formData.append('valor_extra', this.valorExtra)
                formData.append('transportadora_id', this.trasportadoraSelecionada)

                let config = {
                    headers:{
                        'Content-type':'application/x-www-form-urlencoded',
                        'Accept':'application/json'
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.requisicaoStatus = "sucesso";
                        this.requisicaoMsg = "Cadastro realizado com sucesso!";
                    })
                    .catch(errors => {
                        console.log(errors);
                        this.requisicaoStatus = "erro";
                        this.requisicaoMsg = errors.response.data.erro;
                    })

                    
            },

            cotar()
            {
                let formData = new FormData();
                formData.append('uf', this.ufCotacao)
                formData.append('valor_pedido', this.valorPedido)
                formData.append('_method', 'PUT')

                let config = {
                    headers:{
                        '_method':'PUT',
                        'Content-type':'application/x-www-form-urlencoded',
                        'Accept':'application/json',                        
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.resultados = response.data;
                        this.requisicaoStatus = "sucessoCalculo";
                        this.requisicaoMsg = "Consulta realizada com sucesso!";
                    })
                    .catch(errors => {
                        console.log(errors);
                        this.requisicaoStatus = "erroCalculo";
                        this.requisicaoMsg = errors.response.data.erro;
                        this.resultados = null;
                    })
            },
        },
        created(){
            this.getTransportadoras();
            this.getImpostos();
        }
    }
</script>
