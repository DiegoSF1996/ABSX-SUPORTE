<template>
  <div class="col-md-12">
    <h5 class="card-title">Cadastro Chamados</h5>

    <hr />

    <form>
      <div class="col-md-12">
        <div class="form-row mb-2">
          <div class="col-md-2">
            <label class="form-label" v-bind:for="'c' + chamado.cha_codigo"
              >Data Criação
            </label>

            <input
              class="form-control"
              type="date"
              name="cha_datacriacao"
              v-model="chamado.cha_datacriacao"
              v-bind:id="'c' + chamado.cha_codigo"
            />
          </div>
          <div
            v-show="
              chamado.cha_cliente ||
              (this.$root.usuario.logado == true &&
                this.$root.usuario.dadosUsuario.usu_tipousuario == 'ADM')
            "
          >
            >
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
          <div
            v-show="
              chamado.cha_cliente ||
              (this.$root.usuario.logado == true &&
                this.$root.usuario.dadosUsuario.usu_tipousuario == 'ADM')
            "
          >
            >

            <div class="col-md-2">
              <label for="ls_desc_status">Situação</label>
              <select
                class="custom-select"
                id="ls_desc_status"
                name="desc_status"
                v-model="filtros.desc_status"
              >
                <option selected value="">Todos</option>

                <option value="1">Ativado</option>

                <option value="0">Desativado</option>
              </select>
            </div>
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
          <button
            type="button"
            class="btn btn-md btn-primary"
            v-on:click.stop.prevent="say('hi')"
          >
            Salvar
          </button>
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

      chamado: [],
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
      if (chamado.desc_status == undefined) {
        chamado.desc_status = true;
      }
      axios
        .post("/api/salvarDescricao", descricao)
        .then((res) => {
          if (atualiza == true) {
            this.descricaoSalvar.desc_descricao = null;
            this.chamado = {};
            this.lsDescricaoPorOperadora();
          }
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
          console.log(this.erros);
        });
    },
    marcarTodos() {
      this.chamado.forEach((op, indice) => {
        Vue.set(this.chamado[indice], "desc_check", true);
      });
    },
    habilitarDesabilitar() {
      this.chamado.forEach((op, indice) => {
        if (this.chamado[indice].desc_check == true) {
          if (this.chamado[indice].desc_status == true) {
            Vue.set(this.chamado[indice], "desc_status", false);
          } else {
            Vue.set(this.chamado[indice], "desc_status", true);
          }
          this.salvar(this.chamado[indice], false);
        }
      });
      this.lsDescricaoPorOperadora();
    },
    excluir() {
      axios
        .post("/api/excluirDescricoes", this.chamado)
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
          this.chamado = res.data;
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
  },
};
</script>