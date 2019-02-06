import { GeoLocation } from "./GeoLocation";

export class Address {
    constructor(
        public city: string,
        public street:string,
        public suite: string,
        public zipcode: string,
        public geo : GeoLocation,
    ) {
    }
}