<template>
<div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Pilih Tanggal Awal</label>
      <select class="form-control" @click="onClick($event)" v-model="tanggal_start">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Tanggal Akhir</label>
      <select class="form-control" @click="onClick($event)" v-model="tanggal_end">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
  </div>
  <div class="small">
    <line-chart :height="200" :chart-data="datacollection"></line-chart>
  </div>
</div>
</template>

<script>
import LineChart from './LineChart.js'

export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null,
        tanggal_start: '2016',
        tanggal_end: '2019',
        tanggals: [],
        color: ['#ff9800','#e51515', '#15a2e5', '#1b7419', '#551974', '#741958', '#197074' , '#ff8d00', '#648c4c', '#ae98d0']
      }
    },
    mounted () {
      this.getKategori(),
      this.onClick()
    },
    methods: {
        fillData () {
            
        },

        getKategori: function(){
          axios.get('/kajian/data/tahun')
          .then(response => {
            this.tanggals = response.data;
          })
        },

        onClick: function(event){    
            console.log(this.kategori);
            let Years = new Array();
            let Labels = new Array();
            let Jurnal = new Array();
            let Buku = new Array();
            let Artikel = new Array();
            let Lainya = new Array();
            this.axios.get('/kajian/data/chart/' + (this.tanggal_start) + '/' + (this.tanggal_end))
            .then((response) => {
              let data = response.data;
              if(data) {
                    data.forEach(element => {
                        Years.push(element.tahun);
                        Labels.push(element.kategori);
                        Jurnal.push(element.jurnal);
                        Buku.push(element.buku);
                        Artikel.push(element.artikel);
                        Lainya.push(element.dll);
                    });
               
                    this.datacollection = {
                        labels: Years,
                        datasets: [{
                            label: 'Jurnal',
                            backgroundColor: '#00d254',
                            data: Jurnal
                        },
                        {
                            label: 'Buku',
                            backgroundColor: '#af0000',
                            data: Buku
                        },
                        {
                            label: 'Artikel',
                            backgroundColor: '#ff9800',
                            data: Artikel
                        },
                        {
                            label: 'Lain-lain',
                            backgroundColor: '#00a1ff',
                            data: Lainya
                        }
                        ]
                    }, {responsive: true, maintainAspectRatio: false}
                }
            })
        },

        getColor(){
          return (this.color[Math.floor(Math.random()*this.color.length)]);
        }
    }
}

</script>

<style>
  .small {
    max-width: 80%;
    margin:  50px auto;
  }
</style>