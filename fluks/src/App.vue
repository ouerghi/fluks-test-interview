<template>
  <div id="app">
    <div class="container">
      <div class="row">
        <div class="col-sm">

          <div class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" class="form-control" @keyup.enter="postTitle" v-model="pattern"  placeholder="titre à rechercher">
            </div>
            <div class="spinner-border ml-2" v-if="loading"  role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <button  type="submit" class="btn btn-primary mb-2 ml-2" @click="postTitle">Chercher</button>
            <small v-if="help" id="emailHelp" class="form-text text-muted">Error server .</small>
          </div>
          <br>
          <h1>{{count}} Questions:</h1>
          <ul class="list-group">
            <li v-for="(title, index) in titles" class="list-group-item" ><span class="badge badge-secondary">{{index +1}}</span>&nbsp;&nbsp;&nbsp;&nbsp;{{title}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {

  name: 'app',
  data() {
    return {
      pattern : 'pompe',
      titles: null,
      loading:false,
      count:'',
      help :false
  }
  },
  methods :{
    postTitle(){
      this.titles = [];
      this.help=false;
      this.loading = true;
      // POST /someUrl
      this.$http.post('http://localhost:8000/fluks', {text: this.pattern}).then(response => {
        // get body data
        this.titles = response.body.data;
        this.count = response.body.count;
        this.loading = false;

      }
      ).catch((err)=>{
        console.error(err.status);
        if (err.status == 500){
          this.loading = false;
          this.count = 0;
          this.help = true
        }
      });
    }
  },
  mounted() {
    // let self = this;
    // this.$http.get('fluks').then(function(response){
    //   console.log(response)
    //   response.json().then(function (data) {
    //     self.test = data;
    //   })
    // });
  }
}
</script>

<style>
.container{
  margin-top: 60px;
}

</style>
