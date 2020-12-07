<template>
  <div>
    <div v-if="showComponent === 'MovieList'">
      <movie-list-component
        :base_url="base_url"
        @onShowComponent="setShowComponent"
      ></movie-list-component>
    </div>

    <div v-if="showComponent === 'MovieInsert'">
      <movie-insert-component
        :base_url="base_url"
        @onShowComponent="setShowComponent"
      ></movie-insert-component>
    </div>

    <div v-if="showComponent === 'MovieEdit'">
      <movie-edit-component
        :base_url="base_url"
        :movieId="movieId"
        @onShowComponent="setShowComponent"
      ></movie-edit-component>
    </div>
  </div>
</template>

<script>
import MovieList from "./MovieList.vue";
import MovieInsert from "./MovieInsert.vue";
import MovieEdit from "./MovieEdit.vue";

export default {
  name: "movie-main-component",
  components: {
    "movie-list-component": MovieList,
    "movie-insert-component": MovieInsert,
    "movie-edit-component": MovieEdit,
  },
  data() {
    return {
      showComponent: "",
      movieId: ""
    };
  },
  props: {
    base_url: {
      type: String,
      default: "",
    }
  },
  methods: {
    setShowComponent: function (component, id) {
      this.movieId = id
      this.showComponent = component
    },
  },
  mounted() {
    this.setShowComponent("MovieList");
  },
};
</script>

    