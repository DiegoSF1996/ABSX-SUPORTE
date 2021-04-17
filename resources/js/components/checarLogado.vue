<template></template>

<script>
export default {
  mounted() {
    this.verficarLogado();
  },
  methods: {
    verficarLogado() {
      axios
        .get("/api/verficarLogado")
        .then((res) => {
          if (res.data) {
              console.log(this.$root.usuario.dadosUsuario );
            this.$root.usuario.dadosUsuario = res.data.dadosUsuario;
            this.$root.usuario.logado = true;
          }
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
  },
};
</script>
