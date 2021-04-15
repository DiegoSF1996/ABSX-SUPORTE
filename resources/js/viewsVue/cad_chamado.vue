<template>
  <div class="col-md-12">
    <h5 class="card-title">Cadastro Chamados</h5>

    <hr />

    <form>
      <div class="col-md-12">
        <div class="form-row mb-2">
          <div class="col-md-2">
            <label for="cha_datacriacao" class="form-label">Data Criação</label>
            <input
              class="form-control"
              type="date"
              name="cha_datacriacao"
              id="cha_datacriacao"
            />
          </div>

          <div class="col-md-5">
            <label for="cha_assunto" class="form-label">Cliente</label>
            <input
              class="form-control"
              type="text"
              name="cha_assunto"
              id="cha_assunto"
            />
          </div>
          <div class="col-md-5">
            <label for="cha_assunto" class="form-label">Suporte</label>
            <input
              class="form-control"
              type="text"
              name="cha_assunto"
              id="cha_assunto"
            />
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-5 mb-2">
            <label for="cha_assunto" class="form-label">Assunto</label>
            <input
              class="form-control"
              type="text"
              name="cha_assunto"
              id="cha_assunto"
            />
          </div>
          <div class="col-md-2">
            <label for="ls_desc_status">Situação</label>
            <select
              class="custom-select"
              id="ls_desc_status"
              name="desc_status"
              v-model="filtros.desc_status"
              @change="lsDescricaoPorOperadora()"
            >
              <option selected value="">Todos</option>

              <option value="1">Ativado</option>

              <option value="0">Desativado</option>
            </select>
          </div>
          <div class="col-md-12 mb-2">
            <label for="cha_descricao" class="form-label">Descrição</label>
            <textarea
              class="form-control"
              name="cha_descricao"
              id="cha_descricao"
              rows="2"
            ></textarea>
          </div>
        </div>
        <div class="pull-right">
          <button type="button"  class="btn btn-md btn-primary" v-on:click.stop.prevent="say('hi')">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      filtros: {},
      descricaoSalvar: {},
      operadoras: [],
      descricoes: [],
      erros: [],
    };
  },
  mounted() {
    this.lsOperadoras();
    this.lsDescricaoPorOperadora();
  },
  methods: {
        say: function (message) {
      alert(message);
    },

    salvar(descricao, atualiza = false) {
      if (descricao.desc_status == undefined) {
        descricao.desc_status = true;
      }
      axios
        .post("/api/salvarDescricao", descricao)
        .then((res) => {
          if (atualiza == true) {
            this.descricaoSalvar.desc_descricao = null;
            this.descricoes = {};
            this.lsDescricaoPorOperadora();
          }
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
          console.log(this.erros);
        });
    },
    marcarTodos() {
      this.descricoes.forEach((op, indice) => {
        Vue.set(this.descricoes[indice], "desc_check", true);
      });
    },
    habilitarDesabilitar() {
      this.descricoes.forEach((op, indice) => {
        if (this.descricoes[indice].desc_check == true) {
          if (this.descricoes[indice].desc_status == true) {
            Vue.set(this.descricoes[indice], "desc_status", false);
          } else {
            Vue.set(this.descricoes[indice], "desc_status", true);
          }
          this.salvar(this.descricoes[indice], false);
        }
      });
      this.lsDescricaoPorOperadora();
    },
    excluir() {
      axios
        .post("/api/excluirDescricoes", this.descricoes)
        .then((res) => {
          this.lsDescricaoPorOperadora();
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
    limpar() {
      this.descricaoSalvar = {};
    },

    lsOperadoras() {
      axios
        .get("/api/lsOperadoras")
        .then((res) => {
          this.operadoras = res.data;
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
    lsDescricaoPorOperadora() {
      var keyy = Object.keys(this.operadoras).find(
        (key) => this.operadoras[key].ope_codigo == this.filtros.ope_codigo
      );
      if (keyy != undefined) {
        this.descricaoSalvar.ope_descricao = this.operadoras[
          keyy
        ].ope_descricao;
        this.descricaoSalvar.ope_codigo = this.filtros.ope_codigo;
      } else {
        this.descricaoSalvar.ope_codigo = null;
        this.descricaoSalvar.ope_descricao = null;
      }
      axios
        .post("/api/lsDescricaoPorOperadora", this.filtros)
        .then((res) => {
          this.descricoes = res.data;
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
  },
};
</script>