<template>
  <section>
    <div>LISTADO DE USUARIOS</div>
    <div>
      <article>
        <div>
          <label>Nombres</label>
          <input type="text" name="name" v-model="name" @keyup.enter="search">
        </div>
        <div>
          <button @click="search">Buscar</button>
          <button @click="showComponent('UserInsert')">Crear</button>
        </div>
      </article>

      <article>
        <table>
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Email</th>
              <th>Estado</th>
              <th>rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in userList">
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.status_id }}</td>
              <td>{{ user.role_id }}</td>
              <td>
                <button @click="showComponent('UserEdit',user.id)">Editar</button>
                <button @click="deleteUser(user.id)">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </article>
    </div>
  </section>
</template>

<script>
export default {
  name: "user-list-component",
  data() {
    return {
      name: "",
      userList: [],
    };
  },
  props: {
    base_url: {
      type: String,
      default: "",
    },
  },
  methods: {
    showComponent: function (component,id) {
      this.$emit("onShowComponent", component,id);
    },

    search: function () {
      let that = this;

      let headers = {
        headers: {
          "Conten-Type": "application/json",
        },
      };

      let url = this.base_url + "/api/users?name=" + this.name;

      axios
        .get(url, headers)
        .then((response) => {
          if (response.data.type === "success") {
            that.userList = response.data.data;
          } else {
            alert(response.data.message);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteUser: function (id) {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/users/' + id

				axios
					.delete(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							alert(response.data.message)
							that.search()
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			}

  }
}
</script>
