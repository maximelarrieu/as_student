<template>
  <div class="container">
      <form @submit="checkForm">
        <p class="error">responsable > 3 taches || heures taches > 10</p>
        <p v-if="errors.length" class="error">
          Veuillez corriger les erreurs suivantes :
          <ul>
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
          </ul>
        </p>
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Titre de la tâche" v-model="newTask.title" />
          <input class="form-control ml-1" type="text" placeholder="Temps en heure" v-model="newTask.hours" />
          <select class="custom-select ml-1" v-model="newTask.person">
              <option value="" disabled selected>Selectionnez un responsable</option>
              <option v-for="(person, key) in persons" :key="key">
                {{ person }}
              </option>
          </select>
          <button class="btn btn-primary ml-2" type="submit">Ajouter</button>
        </div>
      </form>
      <TheTodoList :tasks="tasks" />
  </div>
</template>

<script>
import TheTodoList from "./TheTodoList.vue"

export default {
  name: "TheTodoForm",
  data() {
    return {
        persons: ["Maxime", "Romain"],
        tasks: [
            { title: "Sortir le chien", hours: 1, person: "Maxime" }
        ],
        newTask: {},
        errors: []
    };
  },
  methods: {
    addTask: function() {
      this.tasks.push(this.newTask)
      this.newTask = {}
    },
    checkForm: function(e) {
      if(!this.newTask.title) {
        this.errors.push('Titre de tâche manquant')
        e.preventDefault();
      } else if(!this.newTask.hours) {
        this.errors.push('Durée de tâche manquante')
        e.preventDefault();
      } else if(!this.newTask.person) {
        this.errors.push('Responsable de la tâche manquant')
        e.preventDefault();
      } else if(isNaN(this.newTask.hours)) {
        this.errors.push('La durée estimée doit être un chiffre ou un nombre')
        e.preventDefault();
      } else {
        e.preventDefault();
        this.addTask();
      }
    }
  },
  components: { TheTodoList }
}
</script>

<style scoped>
.error {
    color: red;
}
</style>
