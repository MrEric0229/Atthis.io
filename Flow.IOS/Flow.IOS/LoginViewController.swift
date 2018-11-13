//
//  LoginViewController.swift
//  Flow.IOS
//
//  Created by yuhanxiao on 5/20/17.
//  Copyright © 2017 yuhanxiao. All rights reserved.
//

import UIKit
import Alamofire

class LoginViewController: UIViewController {
    var Message = String()
    var UserName = String()
    var Authority = String()
    var Token = String()
    var Status = String()
    var ID = Int()

       
    @IBOutlet weak var login_button: UIButton!
    @IBOutlet weak var username_input: UITextField!
    @IBOutlet weak var password_input: UITextField!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        }
    
    @IBAction func login_button(_ sender: Any) {
        login(mode: "normal", token: "nothing")
    }
    
    
    func login_succeed(){
        performSegue(withIdentifier: "GoToMainPage", sender: self)
    }
    
    func login_failed(showError: String){
        self.username_input.text = ""
        self.password_input.text = ""
        let alert = UIAlertController(title: "Login Error", message: showError, preferredStyle: UIAlertControllerStyle.alert)
        alert.addAction(UIAlertAction(title: "Try Again", style: UIAlertActionStyle.default, handler: nil))
        self.present(alert, animated: true, completion: nil)
    }
    
    func login(mode: String, token: String){
        Alamofire.request("http://flow.sushithedog.com/src/Login.php", method: .post, parameters: [
            "mode": mode,
            "username": username_input.text!,
            "password": password_input.text!,
            "token": token
            ])
            .responseJSON { response in
                
                switch response.result.isSuccess {
                case true:
                    if let Message = response.result.value {
                        print(Message)
                        if let dictionary = Message as? [String: Any] {
                            if (dictionary["authority"] as? String) != nil {
                                self.Authority = dictionary["authority"] as! String
                            }
                            if (dictionary["token"] as? String) != nil {
                                UserDefaults.standard.set(dictionary["token"], forKey: "Token")
                                UserDefaults.standard.synchronize()
                                self.Token = dictionary["token"] as! String
                            }
                            if (dictionary["username"] as? String) != nil {
                                self.UserName = dictionary["username"] as! String
                            }
                            if (dictionary["id"] as? String) != nil {
                                self.ID = Int(dictionary["id"] as! String)!
                            }
                            if (dictionary["status"] as? String) != nil {
                                if(dictionary["status"] as? String == "succeed"){
                                    self.Status = dictionary["status"] as! String
                                    self.login_succeed()
                                }
                                else {
                                    self.login_failed(showError: "Invalid UserName or Password")
                                }
                            }
                        }
                    }
                    break
                case false:
                    self.login_failed(showError: "Internet Connect Error")
                    break
                }
        }
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        let MainVC = segue.destination as! UINavigationController
        let targetController = MainVC.topViewController as! ViewController
        targetController.UserName = self.UserName
        targetController.ID = self.ID
        targetController.Authority = self.Authority
    }
    @IBAction func prepareForUnwind(segue: UIStoryboardSegue){}

    
}
