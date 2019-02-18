import { TestBed, inject } from '@angular/core/testing';
import { AuthService } from './auth.service';
import { User } from '../Model/User';


describe('PostServiceService', () => {  
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [AuthService]
    });
  });

  it('should be created', inject([AuthService], (service: AuthService) => {
    expect(service).toBeTruthy();
  }));

  it('should be create one user and return that user', ()=>{
        let user : User = new User("testName","testLastName" , "testEmail" , "username" );
  });

  it('should be return all users', ()=>{
    
  });
 

});
