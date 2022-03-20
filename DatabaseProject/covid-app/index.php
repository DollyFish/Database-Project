<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid App</title>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body style="background-color:DimGrey;">

    <div id="app">
    <h1 style="background-color:White; padding: 20px 50px;">Insert Patient<span class="badge bg-secondary"></span></h1>
        <div class="container">
            
            <button onclick="history.back()" class="btn btn-primary">Go Back</button>&nbsp;&nbsp;
            
            <button @click="insertData" type="button" class="btn btn-success">Insert Data</button>
            
            <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">จังหวัด</th>
                        <th scope="col">จำนวน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="province, index in provinces">
                        <th scope='row'>{{index + 1}}</th>
                        <td>{{province.name}}</td>
                        <td>
                            <input v-model=form[province.name] placeholder='จำนวนผู้ติดเชื้อ'>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

    <script>
        Vue.createApp({
            data() {
                return {
                    form: {},
                    message: 'Test',
                    provinces: []
                }
            },
            created() {

                console.log('App mounted')

                this.fetchData()

            },
            methods: {
                fetchData() {
                    console.log('Fetching data')
                    axios({
                        method: 'get',
                        url: 'api/fetchprovince.php'
                    }).then(result => {
                        console.log('Fetching data completed')
                        console.log(result.data)
                        this.provinces = result.data

                    }).catch(error => {
                        console.log('Fetching data unsuccessfully')
                        console.error(error)
                    })
                },
                insertData() {
                    axios({
                        method: 'post',
                        url: 'api/insert.php',
                        data: this.form,
                        config: {
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        }
                    }).then(result => {
                        console.log(result.data)
                    })
                }
            }
        }).mount('#app')
    </script>

</body>

</html>