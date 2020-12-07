<template>
	<section>
		<div>
			NUEVA PELICULA
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="name">
                <label>Descripción</label>
				<input type="text" v-model="description">
                <label>Usuario</label>
				<input type="text" v-model="user_id">
			</div>
			<div>
				<button @click="insert">Guardar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "movie-insert-component",
		data() {
			return {
                name			:'',	
                description     :'',
                user_id         :''
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'MovieList')
			},		
			insert: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/movies'

				let data = {
                    name	        :this.name,
                    description     :this.description,
                    user_id         :this.user_id,
				}

				axios
					.post(url, data, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {
							alert(response.data.message)
							that.close()
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
