<template>
  <div class="col-md-12">
    <h5 class="card-title">Consulta Usuário</h5>

    <hr />

    <div class="form-row">
      <div class="col-md-5 mb-3">
        <label for="ls_usu_status">Situação</label>

        <select
          class="custom-select"
          name="usu_status"
          v-model="filtros.usu_status"
          @change="lsUsuarioPorFiltro()"
        >
          <option selected value="">Todos</option>

          <option value="1">Ativado</option>

          <option value="0">Desativado</option>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <div class="btn-group" role="group" aria-label="Basic example">
        <div class="mr-2">
          <button
            type="button"
            @click="marcarTodos()"
            class="btn btn-secondary btn-sm"
          >
            <span class="fa fa-check-square"></span>

            Marcar Todos
          </button>
        </div>

        <div class="mr-2">
          <button
            type="button"
            @click="excluir()"
            class="btn btn-secondary btn-sm"
          >
            <span class="fa fa-trash"></span>

            Excluir
          </button>
        </div>

        <div class="mr-2">
          <button
            type="button"
            @click="habilitarDesabilitar()"
            class="btn btn-secondary btn-sm"
          >
            Habilitar e Desabilitar
          </button>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Nome</th>
              <th scope="col">E-mail</th>
              <th scope="col">Telefone</th>
              <th scope="col">Situação</th>
              <th scope="col">Tipo</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>
                <button
                  @click="salvar(usuarioSalvar, true)"
                  type="button"
                  class="btn btn-success"
                >
                  <span class="fa fa-check fa-lg"></span>
                </button>

                <button @click="limpar()" type="button" class="btn btn-danger">
                  <span class="fa fa-times-circle fa-lg"></span>
                </button>
              </td>

              <td>
                <input
                  readonly
                  type="hidden"
                  v-model="usuarioSalvar.usu_status"
                  name="usu_status"
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="usuarioSalvar.usu_nome"
                  name="usu_nome"
                />
              </td>

              <td>
                <input
                  class="form-control"
                  type="email"
                  v-model="usuarioSalvar.usu_email"
                  name="usu_email"
                />
              </td>
              <td>
                <input
                  class="form-control"
                  type="text"
                  v-model="usuarioSalvar.usu_telefone"
                  name="usu_telefone"
                />
              </td>
              <td></td>
              <td>
                <select
                  class="custom-select"
                  name="usu_tipousuario"
                  v-model="usuarioSalvar.usu_tipousuario"
                >
                  <option value="CLI">Cliente</option>
                  <option value="SUP">Suporte</option>
                  <option value="ADM">ADM</option>
                </select>
              </td>
            </tr>

            <tr v-for="usuario in usuarios" :key="usuario.usu_codigo">
              <th scope="row">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="usuario.usu_check"
                  />
                </div>
              </th>

              <td>
                <input
                  readonly
                  type="hidden"
                  name="usu_codigo"
                  v-model="usuario.usu_codigo"
                  @change="salvar(usuario, true)"
                />

                <input
                  type="text"
                  class="form-control"
                  name="usu_nome"
                  v-model="usuario.usu_nome"
                  @change="salvar(usuario, true)"
                />
              </td>

              <td>
                <input
                  type="text"
                  class="form-control"
                  name="usu_email"
                  v-model="usuario.usu_email"
                  @change="salvar(usuario, true)"
                />
              </td>
              <td>
                <input
                  type="text"
                  class="form-control"
                  name="usu_telefone"
                  v-model="usuario.usu_telefone"
                  @change="salvar(usuario, true)"
                />
              </td>
              <td>
                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    name="usu_status"
                    v-model="usuario.usu_status"
                    class="custom-control-input"
                    v-bind:id="'s' + usuario.usu_codigo"
                    @change="salvar(usuario, true)"
                  />

                  <label
                    class="custom-control-label"
                    v-bind:for="'s' + usuario.usu_codigo"
                  ></label>
                </div>
              </td>
              <td>
                <select
                  class="custom-select"
                  name="usu_tipousuario"
                  v-model="usuario.usu_tipousuario"
                  @change="salvar(usuario, true)"
                >
                  <option selected value="CLI">Cliente</option>
                  <option value="SUP">Suporte</option>
                  <option value="ADM">ADM</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      filtros: {},
      usuarioSalvar: {},
      usuarios: [],
      erros: [],
    };
  },
  mounted() {
    //this.lsUsuarios();
    this.lsUsuarioPorFiltro();
  },
  methods: {
    salvar(usuario, atualiza = false) {
      if (usuario.usu_status == undefined) {
        usuario.usu_status = true;
      }
      axios
        .post("/api/salvarUsuario", usuario)
        .then((res) => {
          console.log(res.data);

          if (atualiza == true) {
            this.limpar();
            //this.usuarios = {};
            this.lsUsuarioPorFiltro();
          }
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
          console.log(this.erros);
        });
    },
    marcarTodos() {
      this.usuarios.forEach((op, indice) => {
        this.$set(this.usuarios[indice], "usu_check", true);
      });
    },
    habilitarDesabilitar() {
      this.usuarios.forEach((op, indice) => {
        if (this.usuarios[indice].usu_check == true) {
          if (this.usuarios[indice].usu_status == true) {
            this.$set(this.usuarios[indice], "usu_status", false);
          } else {
            this.$set(this.usuarios[indice], "usu_status", true);
          }
          this.salvar(this.usuarios[indice], false);
        }
      });
      this.lsUsuarioPorFiltro();
    },
    excluir() {
      this.$confirm("Deseja Excluir?")
        .then(() => {
          axios
            .post("/api/excluirUsuario", this.usuarios)
            .then((res) => {
              this.$toasted.success("Removido com sucesso !!!").goAway(1500);
              this.lsUsuarioPorFiltro();
            })
            .catch((error) => {
              this.erros = error.response.data.errors;
            });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    limpar() {
      this.usuarioSalvar = {};
    },

    lsUsuarioPorFiltro() {
      var keyy = Object.keys(this.usuarios).find(
        (key) => this.usuarios[key].usu_status == this.filtros.usu_status
      );
      if (keyy != undefined) {
        this.usuarioSalvar.usu_nome = this.usuarios[keyy].usu_nome;
        this.usuarioSalvar.usu_status = this.filtros.usu_status;
      } else {
        this.usuarioSalvar.usu_status = null;
        this.usuarioSalvar.usu_nome = null;
      }
      axios
        .post("/api/lsUsuarioPorFiltro", this.filtros)
        .then((res) => {
          this.usuarios = res.data;
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
  },
};
</script>