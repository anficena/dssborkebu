<template>
<div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Pilih Kawasan</label>
      <select class="custom-select" @click="onClick($event)" v-model="kawasan">
        <option value="0" >--- Pilih Kawasan ---</option>
        <option v-for="data in kawasans.candi" v-bind:key="data.id" v-bind:value="data.id" >{{ data.nama }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Kategori Observasi</label>
      <select class="custom-select" @click="onClick($event)" v-model="kategori">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in kategoris.kategori" v-bind:key="data.jenis_id" v-bind:value="data.nama_data" >{{ data.nama_data }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Tahun</label>
      <select class="custom-select" @click="onClick($event)" v-model="tanggal">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
  </div>
  <div class="small">
    <h5 class="title text-center"><strong>Grafik Data Klimatologi {{ kategori }} Kawasan {{ kawasan }} Tahun {{ tanggal }}</strong></h5>
    <line-chart :height="200" :chart-data="datacollection" :options="options"></line-chart>
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
        options: null,
        kategori : 'Curah hujan',
        kategoris: [],
        tanggal: '2016',
        tanggals: [],
        kawasan: 1,
        kawasans: [],
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
          axios.get('/iklim/data/kategori')
          .then(response => {
            this.kategoris = response.data;
            this.tanggals = response.data;
            this.kawasans = response.data;
            console.log(response.data);
          })
          
        },

        onClick: function(event){    
            console.log(this.kategori);
            let Month = new Array();
            let Labels = new Array();
            if(((this.kategori) == "Curah hujan") || ((this.kategori) == "Jumlah hari hujan")){
              let Total = new Array();
              let Hari_hujan = new Array();
              this.options = {  
                  scales: {
                      yAxes: [{
                        scaleLabel: {
                          display: true,
                          labelString: 'Jumlah Hari Hujan',
                        },
                        position: 'left',
                        id: '0'
                      }, {
                        scaleLabel: {
                          display: true,
                          labelString: 'Curah Hujan (mm)',
                        },
                        position: 'right',
                        id: '1'
                      }]
                  },
              }
              this.axios.get('/iklim/data/chart/' + (this.kawasan) + '/' + (this.kategori) + '/' + (this.tanggal))
              .then((response) => {
                let data = response.data;
                if(data) {
                      data.forEach(element => {
                          Month.push(element.bulan);
                          Labels.push(element.nama_data);
                          Total.push(element.total);
                          Hari_hujan.push(element.hari_hujan);
                      });
                
                      this.datacollection = {
                          labels: Month,
                          datasets: [{
                              type: 'line',
                              label: 'Curah Hujan',
                              yAxisID: '1',
                              backgroundColor: 'transparent',
                              borderColor: '#0095ff',
                              pointBorderWidth: 2,
                              pointBorderColor: '#001d5dad',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 5,
                              lineTension: 0,
                              data: Total
                          },
                          {
                              
                              type: 'bar',
                              label: 'Hari Hujan',
                              yAxisID: '0',
                              backgroundColor: '#ff9800a3', // Green
                              borderColor: '#d88100',
                              borderWidth: 2,
                              data: Hari_hujan
                          }]
                      }
                  }
              })
            }
            
            if(((this.kategori) == "Temperatur udara maksimal") || ((this.kategori) == "Temperatur udara minimal") || ((this.kategori) == "Temperatur udara rata-rata")){
              let Max = new Array();
              let Min = new Array();
              let Avg = new Array();
              this.options = {  
                  title: {
                    display: true,
                    text: "Data Temperatur Udara Candi Borobudur"
                  },
                  scales: {
                      yAxes: [{
                        scaleLabel: {
                          display: true,
                          labelString: 'Dalam *Celcius',
                        }
                      }]
                  }
              }
               this.axios.get('/iklim/data/chart/' + (this.kawasan) + '/' + (this.kategori) + '/' + (this.tanggal))
              .then((response) => {
                let data = response.data;
                if(data) {
                      data.forEach(element => {
                          Month.push(element.bulan);
                          Labels.push(element.nama_data);
                          Avg.push(element.total);
                          Max.push(element.temp_max);
                          Min.push(element.temp_min);
                      });
                
                      this.datacollection = {
                          labels: Month,
                          datasets: [{
                              type: 'line',
                              label: 'Rata-rata',
                              backgroundColor: 'transparent',
                              borderColor: '#209f1ecc',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#209f1ecc',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Avg
                          },
                          {
                              type: 'line',
                              label: 'Maksimal',
                              backgroundColor: 'transparent',
                              borderColor: '#da1616cc',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#da1616cc',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Max
                          },
                          {
                              type: 'line',
                              label: 'Minimal',
                              backgroundColor: 'transparent',
                              borderColor: '#0095ff',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#0095ff',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Min
                          }]
                      }
                  }
              })
            }

            if(((this.kategori) == "Kelembaban udara maksimal") || ((this.kategori) == "Kelembaban udara minimal") || ((this.kategori) == "Kelembaban udara rata-rata")){
              let Max = new Array();
              let Min = new Array();
              let Avg = new Array();
              this.options = {  
                  title: {
                    display: true,
                    text: "Data Kelembaban Udara Candi Borobudur"
                  },
                  scales: {
                      yAxes: [{
                        scaleLabel: {
                          display: true,
                          labelString: 'Dalam %(Persen)',
                        }
                      }]
                  }
              }
               this.axios.get('/iklim/data/chart/' + (this.kawasan) + '/' + (this.kategori) + '/' + (this.tanggal))
              .then((response) => {
                let data = response.data;
                if(data) {
                      data.forEach(element => {
                          Month.push(element.bulan);
                          Labels.push(element.nama_data);
                          Avg.push(element.total);
                          Max.push(element.kelembaban_max);
                          Min.push(element.kelembaban_min);
                      });
                
                      this.datacollection = {
                          labels: Month,
                          datasets: [{
                              type: 'line',
                              label: 'Rata-rata',
                              backgroundColor: 'transparent',
                              borderColor: '#209f1ecc',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#209f1ecc',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Avg
                          },
                          {
                              type: 'line',
                              label: 'Maksimal',
                              backgroundColor: 'transparent',
                              borderColor: '#da1616cc',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#da1616cc',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Max
                          },
                          {
                              type: 'line',
                              label: 'Minimal',
                              backgroundColor: 'transparent',
                              borderColor: '#0095ff',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#0095ff',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Min
                          }]
                      }
                  }
              })
            }

            if(((this.kategori) == "Penguapan air")){
              let Total = new Array();
              this.options = {  
                  title: {
                    display: true,
                    text: "Data Penguapan Air Candi Borobudur"
                  },
                  scales: {
                      yAxes: [{
                        scaleLabel: {
                          display: true,
                          labelString: 'Dalam *mm',
                        }
                      }]
                  }
              }
               this.axios.get('/iklim/data/chart/' + (this.kawasan) + '/' + (this.kategori) + '/' + (this.tanggal))
              .then((response) => {
                let data = response.data;
                if(data) {
                      data.forEach(element => {
                          Month.push(element.bulan);
                          Labels.push(element.nama_data);
                          Total.push(element.total);
                      });
                
                      this.datacollection = {
                          labels: Month,
                          datasets: [
                          {
                              type: 'line',
                              label: 'Penguapan Air',
                              backgroundColor: 'transparent',
                              borderColor: '#0095ff',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#0095ff',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Total
                          }]
                      }
                  }
              })
            }

            if(((this.kategori) == "Kecepatan angin")){
              let Total = new Array();
              this.options = {  
                  title: {
                    display: true,
                    text: "Data Kecepatan Angin Candi Borobudur"
                  },
                  scales: {
                      yAxes: [{
                        scaleLabel: {
                          display: true,
                          labelString: 'Dalam *Km/jam',
                        }
                      }]
                  }
              }
               this.axios.get('/iklim/data/chart/' + (this.kawasan) + '/' + (this.kategori) + '/' + (this.tanggal))
              .then((response) => {
                let data = response.data;
                if(data) {
                      data.forEach(element => {
                          Month.push(element.bulan);
                          Labels.push(element.nama_data);
                          Total.push(element.total);
                      });
                
                      this.datacollection = {
                          labels: Month,
                          datasets: [
                          {
                              type: 'line',
                              label: 'Kecepatan Angin',
                              backgroundColor: 'transparent',
                              borderColor: '#ff9800',
                              pointBorderWidth: 3,
                              pointRadius: 5,
                              pointBorderColor: '#ff9800',
                              pointBackgroundColor: '#ffffff',
                              pointHoverRadius: 7,
                              pointHoverBorderWidth: 5,
                              lineTension: 0,
                              data: Total
                          }]
                      }
                  }
              })
            }
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