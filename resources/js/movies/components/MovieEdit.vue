<template>
	<section>
		<div>
			EDITAR CATEGORÍA
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="movie.name">

                <label>Descripción</label>
				<input type="text" v-model="movie.description">

                <label>Usuario</label>
				<input type="text" v-model="movie.user_id">

                <label>Estado</label>
				<input type="text" v-model="movie.status_id">
			</div>
			<div>
				<button @click="edit">Editar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "movie-edit-component",
		data() {
			return {				
				movie 		:{
                    name: 	'',		
                    description: '',
                    user_id: ''	,
                    status_id:''	
                
				}
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			},
			movieId: {
				type: Number,
				default: 0
			},
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'MovieList')
			},	
			getMovieById: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/movies/' + this.movieId

				axios
					.get(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							that.movie = response.data.data.movie
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			},
			edit: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/movies/' + this.movieId

				let data = {
                    name	: this.movie.name,
                    description	: this.movie.description,
                    user_id	: this.movie.user_id,
                    status_id	: this.movie.status_id
				}

				axios
					.put(url, data, headers)
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
		},
		mounted() {
			this.getMovieById()
		}
	}
</script>
