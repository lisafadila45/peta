<!DOCTYPE html>
<html lang="id">

<head>
    <title>Peta Leaflet - Peta Rawan Bencana Tanggamus, Lampung</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.css" />
    <style>
        #map {
            height: 80vh; /* Tinggi peta */
            width: 100%;
        }

        .leaflet-control-container {
            display: flex;
            flex-direction: column-reverse;
        }

        .leaflet-control {
            background: white;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            margin: 5px;
        }

        .search-bar input {
            border: none;
            padding: 5px;
            flex: 1;
            margin-right: 5px;
        }

        .search-bar button {
            background: #007bff;
            border: none;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
        }

        .leaflet-control.my-location-button {
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            font-weight: bold;
            cursor: pointer;
        }

        .leaflet-control-zoom {
            display: flex;
            flex-direction: column;
        }

        .leaflet-control-zoom a {
            background-color: #fff;
            border: 1px solid #ccc;
            color: black;
            text-align: center;
            text-decoration: none;
            width: 30px;
            height: 30px;
            line-height: 30px;
            font-size: 20px;
        }

        .leaflet-control-zoom a:hover {
            background-color: #f4f4f4;
        }

        /* Styling untuk header dan footer */
        header, footer {
            background-color: #5c4c5b; /* Warna untuk header dan footer */
            color: white; /* Warna teks putih */
            padding: 5px;
            text-align: center;
            body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    #map {
        height: 80vh; /* Tinggi peta */
        width: 100%;
        background-color: #8b4513; /* Warna coklat untuk area peta */
    }

    .leaflet-control-container {
        display: flex;
        flex-direction: column-reverse;
    }

    .leaflet-control {
        background: white;
        padding: 5px;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        margin: 5px;
    }

    .search-bar input {
        border: none;
        padding: 5px;
        flex: 1;
        margin-right: 5px;
    }

    .search-bar button {
        background: #007bff;
        border: none;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
    }

    .leaflet-control.my-location-button {
        background-color: #fff;
        border: 2px solid #ccc;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        font-weight: bold;
        cursor: pointer;
    }

    .leaflet-control-zoom {
        display: flex;
        flex-direction: column;
    }

    .leaflet-control-zoom a {
        background-color: #fff;
        border: 1px solid #ccc;
        color: black;
        text-align: center;
        text-decoration: none;
        width: 30px;
        height: 30px;
        line-height: 30px;
        font-size: 20px;
    }

    .leaflet-control-zoom a:hover {
        background-color: #f4f4f4;
    }    width: 100%;
            position: fixed;
            left: 0;
            z-index: 1000;
        }

        header {
            top: 0;
        }

        footer {
            bottom: 0;
        }

        .leaflet-control-zoom a:hover {
            background-color: #f4f4f4;
        }
    .coordinate-display {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: auto;
        padding: 6px 12px;
        background: none;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.15);
        color: black;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 0px; 
}
    .coord-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: auto;
        margin-right: 20px;
        background: transparent;
        border: none;
        box-shadow: none;
}
    .leaflet-control-scale {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        color: white !important;
        box-shadow: none !important;
        padding: 4px 6px; 
        font-weight: bold;
        font-size: 14px;
        width: auto;
        text-shadow: none !important;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 0px; 
}
    .leaflet-control-scale span {
        font-size: 16px;
        font-weight: bold;
        color: white !important;
        text-shadow: none !important;
        margin:0px;
}
    .leaflet-control-scale:hover {
        box-shadow: none !important;
        transition: box-shadow 0.3s ease;
}
</style>
</head>

<body>
    <h1>Peta Pesebaran Kerawanan Longsor</h1>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Inisialisasi grup layer
        var KerawananLayer = L.layerGroup();
        var adminLayer = L.layerGroup();
        var desaLayer = L.layerGroup();
        var tutupanLayer = L.layerGroup();
        var batuanLayer = L.layerGroup();
        var THLayer = L.layerGroup();
        var CHLayer = L.layerGroup();
        var Kemiringan = L.layerGroup();
        var jalanLayer = L.layerGroup();
        var kotaLayer = L.layerGroup();
        var TalangLayer = L.layerGroup();
        var lebakLayer = L.layerGroup();
        var CMLayer = L.layerGroup();
        var pariamanLayer = L.layerGroup();

        // Lapisan dasar
        var baseLayers = { 
            'Google Satellite Hybrid': L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
            }),
            'Esri Satellite': L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri'
            }),
            'Open Street Map': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
            'Google Terrain': L.tileLayer('https://mt1.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
            }),
        };
        
        // Membuat peta dengan pusat di Kabupaten Tanggamus
        var map = L.map('map', {
            center: [-5.6, 104.6],
            zoom: 9,
            layers: [baseLayers['Google Satellite Hybrid']],
            zoomControl: false
        });

//........................Area Data tambahan dalam peta.................................................//

 // Menambahkan data GeoJSON untuk kota
 $.getJSON("data/datalain/kota.geojson", function (data) {
    L.geoJson(data, {
        style: {
            color: "#FF4500",    
            weight: 2,          
            dashArray: "5, 5",   
            fillOpacity: 0.7     
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Nama Wilayah: </strong>" + feature.properties.NAMOBJ + "<br>" +
                "<strong>Kode Kabupaten: </strong>" + feature.properties.KDPKAB + "<br>" +
                "<strong>Provinsi: </strong>" + feature.properties.WADMPR + "<br>" +
                "<strong>Luas (km²): </strong>" + feature.properties.LUASWH.toFixed(2) + "<br>" +
                "<strong>Batas Kabupaten: </strong>" + feature.properties.WIADKK
            );
        }
    }).addTo(kotaLayer);
}).fail(function (jqxhr, textStatus, error) {
    console.error("Gagal memuat file GeoJSON:", textStatus, error);
});

// Menambahkan data GeoJSON untuk talang
$.getJSON("data/datalain/Talang.geojson", function (data) {
    L.geoJson(data, {
        style: {
            color: "#7fffd4",    
            weight: 2,            
            dashArray: "5, 5",   
            fillOpacity: 0.7      
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Nama Wilayah: </strong>" + feature.properties.NAMOBJ + "<br>" +
                "<strong>Kode Kabupaten: </strong>" + feature.properties.KDPKAB + "<br>" +
                "<strong>Provinsi: </strong>" + feature.properties.WADMPR + "<br>" +
                "<strong>Luas (km²): </strong>" + feature.properties.LUASWH.toFixed(2) + "<br>" +
                "<strong>Kabupaten: </strong>" + feature.properties.WADMKK
            );
        }
    }).addTo(TalangLayer);
}).fail(function (jqxhr, textStatus, error) {
    console.error("Gagal memuat file GeoJSON:", textStatus, error);
});

// Menambahkan data GeoJSON untuk lebak
$.getJSON("data/datalain/lebak.geojson", function (data) {
    L.geoJson(data, {
        style: {
            color: "#00008b",   
            weight: 2,            
            dashArray: "5, 5",   
            fillOpacity: 0.7      
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Nama Wilayah: </strong>" + feature.properties.NAMOBJ + "<br>" +
                "<strong>Kode Kabupaten: </strong>" + feature.properties.KDPKAB + "<br>" +
                "<strong>Provinsi: </strong>" + feature.properties.WADMPR + "<br>" +
                "<strong>Luas (km²): </strong>" + feature.properties.LUASWH.toFixed(2) + "<br>" +
                "<strong>Kabupaten: </strong>" + feature.properties.WADMKK
            );
        }
    }).addTo(lebakLayer);
}).fail(function (jqxhr, textStatus, error) {
    console.error("Gagal memuat file GeoJSON:", textStatus, error);
});

// Menambahkan data GeoJSON untuk CM
$.getJSON("data/datalain/CM.geojson", function (data) {
    L.geoJson(data, {
        style: {
            color: "#ffa343",    
            weight: 2,           
            dashArray: "5, 5",   
            fillOpacity: 0.7     
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Nama Wilayah: </strong>" + feature.properties.NAMOBJ + "<br>" +
                "<strong>Kode Kabupaten: </strong>" + feature.properties.KDPKAB + "<br>" +
                "<strong>Provinsi: </strong>" + feature.properties.WADMPR + "<br>" +
                "<strong>Luas (km²): </strong>" + feature.properties.LUASWH.toFixed(2) + "<br>" +
                "<strong>Kabupaten: </strong>" + feature.properties.WADMKK
            );
        }
    }).addTo(CMLayer);
}).fail(function (jqxhr, textStatus, error) {
    console.error("Gagal memuat file GeoJSON:", textStatus, error);
});

// Menambahkan data GeoJSON untuk padang
$.getJSON("data/datalain/pariaman.geojson", function (data) {
    L.geoJson(data, {
        style: {
            color: "#00a693",  
            weight: 2,            
            dashArray: "5, 5",   
            fillOpacity: 0.7      
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Nama Wilayah: </strong>" + feature.properties.NAMOBJ + "<br>" +
                "<strong>Kode Kabupaten: </strong>" + feature.properties.KDPKAB + "<br>" +
                "<strong>Provinsi: </strong>" + feature.properties.WADMPR + "<br>" +
                "<strong>Luas (km²): </strong>" + feature.properties.LUASWH.toFixed(2) + "<br>" +
                "<strong>Kabupaten: </strong>" + feature.properties.WADMKK
            );
        }
    }).addTo(pariamanLayer);
}).fail(function (jqxhr, textStatus, error) {
    console.error("Gagal memuat file GeoJSON:", textStatus, error);
});

//................................................Batas Area Tambahan....................................//

    // Warna berdasarkan klasifikasi rawan longsor
    var klasKerawanan = {
        "Rendah": "#00ff00",  
        "Sedang": "#ffff00",  
        "Tinggi": "#ff0000"   
    };

// Menambahkan data GeoJSON untuk area rawan longsor
$.getJSON("data/Kerawanan.geojson", function (data) {
    L.geoJson(data, {
        style: function (feature) {
            var klas = feature.properties.Kerawanan; // Menggunakan properti Kerawanan
            return {
                color: "black",
                fillColor: klasKerawanan[klas] || "#cccccc", // Menggunakan warna berdasarkan 'Kerawanan'
                weight: 0.3,
                opacity: 1,
                fillOpacity: 0.7
            };
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Kerawanan: </strong>" + feature.properties.Kerawanan + "<br>" + // Menampilkan Kerawanan
                "<strong>Bobot: </strong>" + feature.properties.bobot + "<br>" 
                
            );
        }
    }).addTo(KerawananLayer);
}).fail(function () {
    console.error("Gagal memuat data GEOJSON area Kerawanan");
});

        // Menambahkan data GeoJSON untuk batas Administrasi
        $.getJSON("data/Adminstrasi.geojson", function (data) {
            L.geoJson(data, {
                style: function (feature) {
                    return {
                        color: "#CD853F",
                        weight: 3,
                        fillColor: "#CD853F",
                        fillOpacity: 0.5
                    };
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup(
                        "<strong>Nama Administrasi: </strong>" + feature.properties.NAMOBJ + "<br>" +
                        "<strong>Kabupaten: </strong>" + feature.properties.WADMKK + "<br>" +
                        "<strong>Luas: </strong>" + feature.properties.Shape_Area + " m²"
                    );
                }
            }).addTo(adminLayer);
        }).fail(function () {
            console.error("Gagal memuat data GEOJSON Administrasi");
        });

        // Menambahkan data GeoJSON untuk desa
        $.getJSON("data/desa.geojson", function (data) {
            L.geoJson(data, {
                style: {
                    color: "#191970",
                    weight: 3,
                    fillOpacity: 0.5
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup(
                        "<strong>Nama Desa: </strong>" + feature.properties.NAMOBJ + "<br>" +
                        "<strong>Kabupaten: </strong>" + feature.properties.WADMKK + "<br>" +
                        "<strong>Kecamatan: </strong>" + feature.properties.WADMKC
                    );
                }
            }).addTo(desaLayer);
        }).fail(function (jqxhr, textStatus, error) {
            console.error("Gagal memuat file GeoJSON:", textStatus, error);
        });

    // Menambahkan data GeoJSON untuk jaringan jalan
    $.getJSON("data/Jalan.geojson", function (data) {
        L.geoJson(data, {
            style: {
                color: "#FF4500",    
                weight: 2,           
                dashArray: "5, 5",  
                fillOpacity: 0.7
            }
        }).addTo(jalanLayer);
    }).fail(function (jqxhr, textStatus, error) {
        console.error("Gagal memuat file GeoJSON:", textStatus, error);
    });

// warna berdasarkan klasifikasi tutupan lahan
        
      var klastutupan = {
       "Awan": "#00b5e2",
       "Daerah Perairan": "#00b5e2",
       "Lahan Kosong": "#d3d3d3",
       "Lahan Pertanian": "#ffbf00",
       "Lahan Terbangun": "#f0e68c",
       "Rawa": "#228b22",
       "Semak Belukar": "#228b22",
       "Vegetasi": "#228b22"
    };

// Menambahkan data GeoJSON untuk area Tutupan Lahan
$.getJSON("data/tutupan.geojson", function (data) {
    console.log("Data GeoJSON berhasil dimuat:", data); 

    L.geoJson(data, {
        style: function (feature) {
            var klas = feature.properties.Tutupan_L; 
            if (!klastutupan[klas]) {
                console.warn("Kategori tidak ditemukan:", klas);
            }
            return {
                color: "black",
                fillColor: klastutupan[klas] || "#cccccc", 
                weight: 0.3,
                opacity: 1,
                fillOpacity: 0.7
            };
        },
        onEachFeature: function (feature, layer) {
            var klas = feature.properties.Tutupan_L; 
            layer.bindPopup(
                "<strong>Tutupan Lahan: </strong>" + klas + "<br>" +
                "<strong>Area: </strong>" + feature.properties.Shape_Area + " m²"
            );
            console.log("Kategori:", klas, "Warna:", klastutupan[klas]);
        }
        }).addTo(tutupanLayer); 
    }).fail(function () {
        console.error("Gagal memuat data GeoJSON tutupan lahan");
    });

// Definisi warna untuk klasifikasi batu
var klasbatu = {
    "Vulkanik": "#8B0000",
    "Sedimen": "#FF4500",
    "Granite": "#FFD700",
    "Alluvium": "#DAA520",
};

// Menambahkan data GeoJSON untuk area batuan ke layer yang sudah ada
$.getJSON("data/batu.geojson", function (data) {
    console.log("Data GeoJSON berhasil dimuat:", data);

    L.geoJson(data, {
        // Definisi gaya untuk setiap fitur berdasarkan kategori batu
        style: function (feature) {
            var klas = feature.properties.NAMOBJ; // Pastikan kategori diambil dari NAMOBJ
            if (!klasbatu[klas]) {
                console.warn("Kategori tidak ditemukan:", klas);
            }
            return {
                color: "black", // Warna garis tepi
                fillColor: klasbatu[klas] || "#cccccc", // Warna isi default jika kategori tidak ditemukan
                weight: 0.3,
                opacity: 1,
                fillOpacity: 0.7,
            };
        },

        // Menambahkan event dan popup untuk setiap fitur
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Nama Batuan:</strong> " + (feature.properties.NAMOBJ || "Tidak diketahui") + "<br>" +
                "<strong>Kategori Umur:</strong> " + (feature.properties.UMUROBJ || "Tidak diketahui") + "<br>"
            );
        },
    }).addTo(batuanLayer);
}).fail(function () {
    console.error("Gagal memuat data GeoJSON batu");
});

// Definisikan warna untuk setiap kategori tanah
var soilColors = {
   "Histosol": "#654321",  
    "Andisol": "#808080",   
    "Latosol": "#B22222",  
    "Aluvial": "#F5DEB3",   
    "Organosol": "#000000", 
    "Entisol": "#8B4513",   
    "Regosol": "#FFD700"    
};

// Definisikan layer untuk TH
var THLayer = L.layerGroup();

// Memuat data GeoJSON untuk TH
$.getJSON("data/TH.geojson", function (data) {
    console.log("Data GeoJSON TH berhasil dimuat:", data); 

    L.geoJson(data, {
        style: function (feature) {
            var kategoriTH = feature.properties.DOMSOI; 
            var warnaTH = soilColors[kategoriTH] || "#cccccc"; // Default jika kategori tidak ada

            return {
                color: "black",
                fillColor: warnaTH,
                weight: 1,
                opacity: 1,
                fillOpacity: 0.7
            };
        },
        onEachFeature: function (feature, layer) {
            var popupContent = `
                <strong>FAO Soil:</strong> ${feature.properties.FAOSOIL}<br>
                <strong>Dominant Soil:</strong> ${feature.properties.DOMSOI}
            `;
            layer.bindPopup(popupContent);
        }
    }).addTo(THLayer); 

}).fail(function () {
    console.error("Gagal memuat data GeoJSON TH");
});

var hujanColors = {
    "Sangat Kering": "#FFDDC1", // Oranye Muda
    "Kering": "#FFAA00",        // Oranye
    "Sedang": "#6495ED",       // Biru Sedang
    "Basah": "#008B8B",        // Biru Tua
    "Sangat Basah": "#00008B"   // Biru Gelap
};

// Mendefinisikan layer hujan
var CHLayer = L.layerGroup(); // Membuat layer group untuk curah hujan

$.getJSON("data/ch.geojson", function (data) {
    console.log("Data GeoJSON CH berhasil dimuat:", data);

    L.geoJson(data, {
        style: function (feature) {
            var kategoriCH = feature.properties.Klasifikas;
            var warnaHujan = hujanColors[kategoriCH] || "#cccccc"; // Default abu-abu jika tidak ada kategori

            return {
                color: "black",   // Warna garis tepi
                fillColor: warnaHujan, // Warna berdasarkan klasifikasi
                weight: 1,         // Ketebalan garis batas
                opacity: 1,
                fillOpacity: 0.7   // Transparansi warna isi
            };
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Klasifikasi Curah Hujan: </strong>" + feature.properties.Klasifikas + "<br>" +
                "<strong>Curah Hujan (mm): </strong>" + feature.properties.Ket + "<br>"
            );
        }
    }).addTo(CHLayer); // Menambahkan data ke layer hujan

}).fail(function () {
    console.error("Gagal memuat data GeoJSON curah hujan");
});


// Inisialisasi grup layer
var kemiringanLayer = L.layerGroup(); // Layer untuk Kemiringan

// Warna berdasarkan klasifikasi kemiringan
var klasKemiringan = {
    "Datar": "#00FF00",          // Hijau untuk Datar
    "Landai": "#FFD700",        // Emas untuk Landai
    "Agak Curam": "#FFA500",     // Orange untuk Agak Curam
    "Curam": "#FF4500",          // Merah Oranye untuk Curam
    "Sangat Curam": "#FF0000"    // Merah untuk Sangat Curam
};

// Menambahkan data GeoJSON untuk kemiringan lereng
$.getJSON("data/kemiringan.geojson", function (data) {
    L.geoJson(data, {
        style: function (feature) {
            var klas = feature.properties.Klasifikas; // Klasifikasi kemiringan
            return {
                color: "black",
                fillColor: klasKemiringan[klas] || "#cccccc", // Menentukan warna berdasarkan klasifikasi
                weight: 0.3,
                opacity: 1,
                fillOpacity: 0.7
            };
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(
                "<strong>Kemiringan: </strong>" + feature.properties.Kemiringan + "<br>" +
                "<strong>Klasifikasi: </strong>" + feature.properties.Klasifikas
            );
        }
    }).addTo(kemiringanLayer);
}).fail(function () {
    console.error("Gagal memuat data GEOJSON kemiringan lereng");
});

// Misalkan Anda sudah memiliki layer 'jalurEvakuasi' yang telah didefinisikan sebelumnya
const jalurEvakuasi = L.layerGroup(); // Membuat layerGroup untuk jalur evakuasi

// GeoJSON data
const geojsonData = {
    "type": "FeatureCollection",
    "features": [
        { "type": "Feature", "properties": { "Name": "Jalur Evakuasi 4" }, "geometry": { "type": "Point", "coordinates": [104.706195629000035, -5.455886500999952] } },
        { "type": "Feature", "properties": { "Name": "Jalur Evakuasi 1" }, "geometry": { "type": "Point", "coordinates": [104.705444596000063, -5.455665884999974] } },
        { "type": "Feature", "properties": { "Name": "Jalur Evakuasi 2" }, "geometry": { "type": "Point", "coordinates": [104.705703349000032, -5.455713263999939] } },
        { "type": "Feature", "properties": { "Name": "Jalur Evakuasi 3" }, "geometry": { "type": "Point", "coordinates": [104.705968797000082, -5.455767636999951] } }
    ]
};

// Tambahkan GeoJSON ke dalam layer 'jalurEvakuasi' tanpa menambahkannya ke peta
L.geoJSON(geojsonData, {
    onEachFeature: function (feature, layer) {
        layer.bindPopup(feature.properties.Name);
    }
}).addTo(jalurEvakuasi); // Menambahkan ke jalurEvakuasi

let evacuationVisible = false; // Flag untuk melacak visibilitas

// Buat tombol kontrol untuk menampilkan/menyembunyikan jalur evakuasi
const button = L.control({ position: 'topright' });
button.onAdd = function () {
    const div = L.DomUtil.create('div', 'show-button');
    div.innerHTML = '<button id="toggleButton">Tampilkan Jalur Evakuasi</button>';
    return div;
};
button.addTo(map);

// Tambahkan event listener untuk tombol
document.getElementById('toggleButton').onclick = function () {
    if (evacuationVisible) {
        map.removeLayer(jalurEvakuasi); // Menghilangkan layer dari peta
        this.innerHTML = 'Tampilkan Jalur Evakuasi'; // Ubah teks tombol
    } else {
        jalurEvakuasi.addTo(map); // Menambahkan jalurEvakuasi ke peta
        this.innerHTML = 'Sembunyikan Jalur Evakuasi'; // Ubah teks tombol
    }
    evacuationVisible = !evacuationVisible; // Toggle flag
};

// Definisi groupedOverlays
var groupedOverlays = {
    "Peta Administrasi": {
        'Batas Administrasi': adminLayer,
        'Desa Batu Kramat': desaLayer
    },
    "Peta Jaringan Jalan": { 
        'Jaringan Jalan': jalanLayer
    },
    "Peta Kerawanan": {
        'Rawan Longsor': KerawananLayer
    },
    "Peta Tutupan Lahan": {
        'Tutupan Lahan': tutupanLayer
    },
    "Peta Geologi": {
        'Batuan': batuanLayer,
        'Tanah' : THLayer
    },
    "Peta Curah Hujan": {
        'Curah Hujan': CHLayer
    },
    "Peta Kemiringan Lereng": {
        'Kemiringan Lereng': kemiringanLayer 
    },
    "Peta Lain": {
        'kota' : kotaLayer,
        'Talang' : TalangLayer,
        'lebak' : lebakLayer,
        'Cinta Makmur' : CMLayer,
        'Padang Pariaman' : pariamanLayer
    }
};

// Tambahkan kontrol layer tanpa otomatis menambahkannya ke peta
layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
    position: 'topright', // Menetapkan posisi kontrol layer tetap di sebelah kanan atas
    onLayerAdd: function (eventLayer) {
        if (!map.hasLayer(eventLayer.layer)) {
            eventLayer.layer.addTo(map);
        }
    },
    onLayerRemove: function (eventLayer) {
        if (map.hasLayer(eventLayer.layer)) {
            map.removeLayer(eventLayer.layer);
        }
    }
}).addTo(map);

        // Tambahkan bar pencarian
        var searchBar = L.control({ position: 'topleft' });
        searchBar.onAdd = function () {
            var div = L.DomUtil.create('div', 'leaflet-control search-bar');
            div.innerHTML = '<input type="text" id="search-input" placeholder="Cari lokasi..." /><button id="search-button">Cari</button>';
            return div;
        };
        searchBar.addTo(map);

        document.getElementById('search-button').addEventListener('click', function () {
            var location = document.getElementById('search-input').value;
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var latlng = [data[0].lat, data[0].lon];
                        map.setView(latlng, 13);
                        L.marker(latlng).addTo(map)
                            .bindPopup(`<b>${location}</b>`)
                            .openPopup();
                    } else {
                        alert("Lokasi tidak ditemukan");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Terjadi kesalahan saat mencari lokasi");
                });
        });

        // Menampilkan koordinat di dalam kotak
        var coordDisplay = L.control({ position: 'bottomleft' });
        coordDisplay.onAdd = function () {
            var div = L.DomUtil.create('div', 'coordinate-display');
            div.innerHTML = `
                <div class="coord-box">
                    <div class="coord-display">Koordinat: 0.000, 0.000 Degrees</div>
                </div>
            `;
            return div;
        };

        // Menambahkan koordinat ke peta
        coordDisplay.addTo(map);

        // Tambahkan skala pengukur jarak
        var scaleControl = L.control.scale({ position: 'bottomleft', imperial: false });
        scaleControl.addTo(map);

        // Menambahkan CSS untuk memastikan skala di atas koordinat
        var scaleStyle = document.createElement('style');
        scaleStyle.innerHTML = `
            .leaflet-control-scale {
                margin-bottom: 35px; /* Mengatur jarak di bawah skala */
            }
        `;
        document.head.appendChild(scaleStyle);

        // Fungsi untuk memperbarui koordinat pada tampilan
        function updateCoordinates(e) {
            var lat = e.latlng.lat.toFixed(3);  // Membulatkan koordinat lintang hingga 3 angka desimal
            var lng = e.latlng.lng.toFixed(3);  // Membulatkan koordinat bujur hingga 3 angka desimal

            // Menentukan arah berdasarkan nilai koordinat
            var latDirection = lat >= 0 ? 'N' : 'S';  // 'N' untuk utara, 'S' untuk selatan
            var lngDirection = lng >= 0 ? 'E' : 'W';  // 'E' untuk timur, 'W' untuk barat

            // Memperbarui tampilan koordinat dengan ikon dan simbol derajat serta arah
            coordDisplay.getContainer().querySelector('.coord-display').innerHTML = 
                `<span style="display: inline-flex; align-items: center;">
                    <img src="assets/images/coordinates.png" alt="Coordinates" style="width: 20px; height: 20px; margin-right: 8px;" /> 
                    Koordinat: ${Math.abs(lng)}° ${lngDirection}, ${Math.abs(lat)}° ${latDirection}
                </span>`;  // Menampilkan koordinat dengan ikon di sampingnya
        }

        // Fungsi untuk menampilkan koordinat awal saat halaman pertama kali dimuat
        function displayInitialCoordinates() {
            var initialLat = map.getCenter().lat.toFixed(3);  // Mendapatkan koordinat lintang awal peta
            var initialLng = map.getCenter().lng.toFixed(3);  // Mendapatkan koordinat bujur awal peta

            // Menentukan arah berdasarkan nilai koordinat
            var latDirection = initialLat >= 0 ? 'N' : 'S';
            var lngDirection = initialLng >= 0 ? 'E' : 'W';

            // Memperbarui tampilan koordinat dengan ikon dan simbol derajat serta arah
            coordDisplay.getContainer().querySelector('.coord-display').innerHTML = 
                `<span style="display: inline-flex; align-items: center;">
                    <img src="assets/images/coordinates.png" alt="Coordinates" style="width: 20px; height: 20px; margin-right: 8px;" /> 
                    Koordinat: ${Math.abs(initialLng)}° ${lngDirection}, ${Math.abs(initialLat)}° ${latDirection}
                </span>`;  // Menampilkan koordinat awal dengan ikon
        }

        // Tambahkan event listener untuk menampilkan koordinat saat mouse bergerak
        map.on('mousemove', updateCoordinates);

        // Menampilkan koordinat awal setelah peta dimuat
        window.addEventListener('load', function() {
            // Tampilkan koordinat saat halaman pertama kali dimuat
            displayInitialCoordinates();
        });

// Tambahkan tombol "My Location"
var myLocationButton = L.control({ position: 'topleft' });
myLocationButton.onAdd = function () {
    var div = L.DomUtil.create('div', 'leaflet-control my-location-button');
    div.innerHTML = '<img src="https://img.icons8.com/material-rounded/24/000000/navigation--v1.png"/>';
    return div;
};
myLocationButton.addTo(map);

// Fungsi untuk melokasikan pengguna
function locateUser() {
    map.locate({ setView: true, maxZoom: 15 });
}

// Event listener untuk tombol "My Location"
document.querySelector('.leaflet-control.my-location-button').addEventListener('click', locateUser);

// Ketika lokasi ditemukan, tambahkan lingkaran biru sebagai penanda lokasi
map.on('locationfound', function(e) {
    // Tambahkan lingkaran biru
    var radius = e.accuracy / 2; // Gunakan akurasi untuk menentukan radius
    var userCircle = L.circle(e.latlng, {
        color: '#3388ff',         // Warna border lingkaran
        fillColor: '#3388ff',     // Warna isi lingkaran (biru)
        fillOpacity: 0.5,         // Transparansi isi
        radius: radius            // Radius lingkaran (akurasi GPS)
    }).addTo(map);

    // Tambahkan titik pusat biru
    var userMarker = L.circleMarker(e.latlng, {
        radius: 3,                // Ukuran titik biru
        color: '#0078ff',         // Warna border
        fillColor: '#0078ff',     // Warna isi titik
        fillOpacity: 2            // Transparansi isi
    }).addTo(map);

});

// Jika lokasi tidak ditemukan, berikan peringatan
map.on('locationerror', function(e) {
    alert("Location access denied or not available.");
});

         // Refresh the layer control
         layerControl.remove(map);
                layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
                    position: 'topright' // Menetapkan posisi kontrol layer tetap di sebelah kanan atas
                }).addTo(map);

        // Tambahkan kontrol zoom kustom
        var zoomControl = L.control({ position: 'topleft' });
        zoomControl.onAdd = function () {
            var div = L.DomUtil.create('div', 'leaflet-control-zoom leaflet-bar leaflet-control');
            div.innerHTML = ` 
                <a class="leaflet-control-zoom-in" href="#" title="Zoom in"><span aria-hidden="true">+</span></a>
                <a class="leaflet-control-zoom-out" href="#" title="Zoom out"><span aria-hidden="true">−</span></a>
            `;
            return div;
        };
        zoomControl.addTo(map);
    </script>
</body>

</html>