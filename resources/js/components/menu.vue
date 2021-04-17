<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="">ABSX</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div v-show="this.$root.usuario.logado">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <router-link class="nav-link" to="/cons_chamado" exact
                >Chamados</router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/cons_usuario"
                >Usuários</router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/sair">Sair</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div v-show="this.$root.usuario.dadosUsuario.usu_nome" class=" col-md-12 ">
      <div class="pull-right">

      <h3>Usuário: {{ this.$root.usuario.dadosUsuario.usu_nome }}</h3>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    if (this.$root.usuario.logado) {
      let myToast = this.$toasted.info("Você já está logado !!").goAway(1500);
      this.$router.push("cons_chamado");
    } else {
      let myToast = this.$toasted
        .info("Você não está logado, por favor, faça login !!")
        .goAway(1500);
      this.$router.push("login");
    }
  },
  methods: {
    verificaLogado() {
      if (this.$root.usuario.logado) {
        let myToast = this.$toasted.info("Você já está logado !!").goAway(1500);
        this.$router.push("cons_chamado");
      } else {
        let myToast = this.$toasted
          .info("Você não está logado, por favor, faça login !!")
          .goAway(1500);
        this.$router.push("login");
      }
    },
  },
};
</script>
