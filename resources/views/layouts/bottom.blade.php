        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script>
            let asset_url = '{{asset('assets/css/app.min.css')}}';
            let bootstrap_url = '{{asset('assets/css/bootstrap.min.css')}}';
        </script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        <script>
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            // window.addEventListener('load', function () {
            //     postData('{{ route("pelanggan.data") }}','POST', { _token: csrfToken ,id: 1 })
            // .then(data => {
            //     console.log(data); // JSON data parsed by `data.json()` call
            // });
            // })

            async function postData(url = '', url_method = 'POST',  data = {}) {
                const response = await fetch(url, {
                    method: url_method,
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin',
                    headers: {
                    "X-CSRFToken" :csrfToken,
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",

                    },
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body: JSON.stringify(data)
                });
                return response.json();
            }
        </script>

        @stack('scripts')

    </body>
</html>