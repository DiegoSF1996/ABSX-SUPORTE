<template>
  <div class="col-md-12">
    <h5 class="card-title">Login</h5>
    <hr />
    <form>
      <div class="col-md-10">
        <div class="col-md-10">
          <div class="mb-2">
            <label>E-mail</label>
            <input
              type="text"
              class="form-control"
              name="usu_email"
              v-model="usuario.usu_email"
            />
          </div>
          <div class="pull-right">
            <button
              type="button"
              class="btn btn-md btn-primary"
              v-on:click.stop.prevent="logar()"
            >
              Acessar
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      usuario: {},
      erros: [],
    };
  },
  mounted() {},
  methods: {
    // myToast.text("Changing the text !!!").goAway(1500);
    /*  this.$toasted.success('hello billo'); */

    logar() {
      axios
        .post("/api/logar", this.usuario)
        .then((res) => {
          if (res.data.mensagem == 1) {
            this.$toasted.success("Autenticado com sucesso !!!").goAway(1500);
            this.$root.usuario.dadosUsuario = res.data.dadosUsuario;
            this.$root.usuario.logado = true;
            this.$router.push("cons_chamado");
          } else {
            this.$toasted
              .info("Usuário não encontrado, tente novamente !!!")
              .goAway(1500);
          }
        })
        .catch((error) => {
          this.$toasted.error("Tente novamente !!!").goAway(1500);
        });
    },
  },
};
</script>