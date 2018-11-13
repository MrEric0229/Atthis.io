# Backend API

## Beta

//


### Car

-   GetAllCars
    -   Link: _host_/api/Car/GetAllCars.php
    -   POSTS
        -   nothing

Response
 ```js
Response = Array<Car>
Car = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    comments: String,
    picture: Array<String>
}
```

//check reponded null

### Customer

-   GetAllCustomers
    -   Link: _host_/api/Customer/GetAllCustomers.php
    -   POSTS
        -   nothing

Response
 ```js
Response = Array<Customer>
Customer = {
    id: Number,
    name: String,
    email: String,
    phone: String,
    address: String
}
```
### Detail

-   GetDetailDetail
    -   Link: _host_/api/Detail/GetDetailDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
    id: Number,
    stage: Number,
    manager: String,
    detailManager: String,
    level: String,
    picture: Array<string>||null,
    note: String||null,
    comment: String,
    carInfo: <carInfo>
}
carInfo = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    comments: String,
    picture: Array<String>||null
}
```

### Finance

-   GetFinanceDetail
    -   Link: _host_/api/Finance/GetFinanceDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
    id: Number,
    selling: <selling>,
    manager: String,
    seller: String,
    accounting: String,
    picture: Array<string>||null,
    URL：String||null,
    financeManager: String,
    bankName: String||null,
    stage: String
}

selling = {
    id: Number,
    stage: String,
    manager: String,
    managerId: Number,
    accounting: String,
    accountingId: Number,
    seller: String,
    sellerId: Number,
    Customer: <Customer>,
    car: <Car>,
    budget: String||null,
    priceDrop: String,
    url: String||null,
    vin: String||null,
    payment: String||null,
    remaining: String||null,
    tradeIn: Boolean,
    tradeInPrice: String||null,
    note: String,
    managerPrice: String||null,
    mode: String||null,
    deposit: String,
    trackingNumber: String||null,
    photo: String,
    sellingPrice: String
}

Customer = {
    name: String,
    email: String,
    phone: String,
    address: String
}
Car = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    comments: String,
    picture: Array<String>||null
}
```

### Freight

-   GetFreightDetail
    -   Link: _host_/api/Freight/GetFreightDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
    id: Number,
    stage: String,
    prePrice: String,
    finalPrice: String||null,
    manager: String,
    frontDesk: String,
    note: String,
    location: String,
    carInfo: <carInfo>
}

carInfo = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    comments: String,
    picture: Array<String>||null
}
```
//inventory responded nothing

### Notice

-   GetNoticeDetail
    -   Link: _host_/api/Notice/GetNoticeDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
    id: Number,
    from: String,
    notice: String
}
```

### Paperwork

-   GetPaperworkDetail
    -   Link: _host_/api/Paperwork/GetPaperworkDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
    id: Number,
    selling: <selling>,
    frontDesk: String,
    accounting: String,
    manager: String,
    seller: String,
    car: <car>,
    customer: <customer>,
    type: String,
    tracking: String,
    pickUp: String,
    stage: String
}

selling = {
    id: Number,
    stage: String,
    manager: String,
    managerId: Number,
    accounting: String,
    accountingId: Number,
    seller: String,
    sellerId: Number,
    customer: <Customer>,
    car: <car>,
    budget: String||null,
    priceDrop: String,
    url: String||null,
    vin: String||null,
    payment: String||null,
    remaining: String||null,
    tradeIn: Boolean,
    tradeInPrice: String||null,
    note: String,
    managerPrice: String||null,
    mode: String||null,
    deposit: String,
    trackingNumber: String||null,
    photo: String||null,
    sellingPrice: String
    freight1: <freight>,
    freight2: String||null,
    service: <service>,
    detail: <detail>,
    finance: Finance||null
}

car = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    comments: String,
    picture: Array<String>||null
}

customer = {
    __initializer__: String||null,
    __cloner__: String||null,
    __isInitialized__: Boolean
}

Customer = {
    name: String,
    email: String,
    phone: String,
    address: String
}

freight = {
  id: Number,
  stage: String,
  prePrice: String,
  finalPrice: String||null,
  manager: String,
  frontDesk: String,
  note: String,
  location: String,
  carInfo: <carInfo>
}

carInfo = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    comments: String,
    picture: Array<String>||null
}

service = {
    id: Number,
    stage: String,
    price: String||null,
    finalPrice: String||null,
    manager: String,
    accounting: String,
    serviceManager: String,
    pickedUpBy: String||null,
    checkedBy: String||null,
    resultReport: String||null
    note: String,
    carInfo: <carInfo>
}

detail = {
    id: Number,
    stage: Number,
    manager: String,
    detailManager: String,
    level: String,
    picture: Array<string>||null,
    note: String||null,
    comment: String,
    carInfo: <carInfo>
}
```

### Selling

-   GetSellingDetail
    -   Link: _host_/api/Selling/GetSellingDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
  id: Number,
  stage: String,
  manager: String,
  managerId: Number,
  accounting: String,
  accountingId: Number,
  seller: String,
  sellerId: Number,
  customer: <Customer>,
  car: Car||null,
  budget: String,
  priceDrop: String||null,
  url: String,
  vin: String||null,
  payment: String||null,
  remaining: String||null,
  tradeIn: Boolean,
  tradeInPrice: String||null,
  note: String,
  managerPrice: String||null,
  mode: String||null,
  deposit: String|null,
  trackingNumber: String||null,
  photo: String||null,
  sellingPrice: String||null,
  freight1: String||null,
  freight2: String||null,
  service: Service||null,
  detail: Detail||null,
  finance: Finance||null
}

Customer = {
    name: String,
    email: String,
    phone: String,
    address: String
}
```

### Service

-   GetServiceDetail
    -   Link: _host_/api/Service/GetServiceDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
    id: Number,
    stage: String,
    price: String||null,
    finalPrice: String||null,
    manager: String,
    accounting: String,
    serviceManager: String,
    pickedUpBy: String||null,
    checkedBy: String||null,
    resultReport: String||null
    note: String,
    carInfo: <carInfo>
}

carInfo = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    comments: String,
    picture: Array<String>||null
}
```

### TBuy

-   GetTBuyDetail
    -   Link: _host_/api/TBuy/GetTBuyDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
    id: Number,
    stage: String,
    roleInfo: <roleInfo>,
    accountingPrice: String||null,
    tradeInPrice: String||null,
    retailPrice: String||null,
    maxPrice: String||null,
    finalPrice: String||null
}

roleInfo = {
    id: Number,
    make: String,
    model: String,
    year: String,
    vin: String,
    mileage: String,
    exteriorColor: String,
    interiorColor: String,
    fuel: String,
    engine: String,
    transmission: String,
    driveType: String,
    bodyStyle: String,
    pictures: Array<String>
}
```

### TradeIn

-   GetTradeInDetail
    -   Link: _host_/api/TradeIn/GetTradeInDetail.php
    -   POSTS
        -   taskId -> int

Response
 ```js
Response = {
