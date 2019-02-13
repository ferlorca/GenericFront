import { Address } from "./Adress";
import { GeoLocation } from "./GeoLocation";

export class User {    
        
  constructor(
    public id: string =null,
    public name: string=null,
    public email: string=null,
    public username: string=null,
    public address: Address=null                  
            ){
            } 

    generateUserByJson(json:any){
      let auxgeo = new GeoLocation(
        json.address.geo.lat,
        json.address.geo.lng
      );
      let auxadress = new Address(
        json.address.city,
        json.address.street,
        json.address.suite,
        json.address.zipcode,
        auxgeo,
      );
      this.name=json.name;
      this.id=json.id;
      this.email=json.email;
      this.username=json.username;
      this.address=auxadress;
      return this;
    }
  }