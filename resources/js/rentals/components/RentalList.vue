<template>
  <section>
    <div>LISTADO DE RENTAS</div>
    <div>
      <article>
        <div>
          <label>INGRESE ID</label>
          <input type="text" name="id" v-model="id" @keyup.enter="search" />
        </div>
        <div>
          <button @click="search">Buscar</button>
          <button @click="showComponent('RentalInsert')">Crear</button>
        </div>
      </article>

      <article>
        <table>
          <thead>
            <tr>
              <th>id</th>
              <th>Fecha de inicio</th>
              <th>Fecha final</th>
              <th>Total</th>
              <th>Usuario</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="rental in rentalList">
              <td>{{ rental.id }}</td>
              <td>{{ rental.start_date }}</td>
              <td>{{ rental.end_date }}</td>
              <td>{{ rental.total }}</td>
              <td>{{ rental.user_id }}</td>
              <td>{{ rental.status_id }}</td>
              <td>
                <button @click="showComponent('RentalEdit', rental.id)"> Editar</button>
                <button @click="deleteRental(rental.id)">Eliminar</button>
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
  name: "rental-list-component",
  data() {
    return {
      id: "",
      rentalList: [],
    };
  },
  props: {
    base_url: {
      type: String,
      default: "",
    },
  },
  methods: {
    showComponent: function (component, id) {
      this.$emit("onShowComponent", component, id);
    },

    search: function () {
      let that = this;

      let headers = {
        headers: {
          "Conten-Type": "application/json",
        },
      };

      let url = this.base_url + "/api/rentals?id=" + this.id;

      axios
        .get(url, headers)
        .then((response) => {
          if (response.data.type === "success") {
            that.rentalList = response.data.data;
          } else {
            alert(response.data.message);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteRental: function (id) {
      let that = this;

      let headers = {
        headers: {
          "Conten-Type": "application/json",
        },
      };

      let url = this.base_url + "/api/rentals/" + id;

      axios
        .delete(url, headers)
        .then((response) => {
          if (response.data.type === "success") {
            alert(response.data.message);
            that.search();
          } else {
            alert(response.data.message);
          }
        })
        .catch((error) => {
          alert(error.data.message);
        });
    },
  },
};
</script>
