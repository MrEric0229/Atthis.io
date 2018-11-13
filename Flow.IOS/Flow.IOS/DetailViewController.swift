//
//  DetailViewController.swift
//  Flow.IOS
//
//  Created by yuhanxiao on 5/25/17.
//  Copyright © 2017 yuhanxiao. All rights reserved.
//

import UIKit
import Alamofire

class DetailViewController: UIViewController {

    
    @IBOutlet var ID: UILabel!
    
    @IBOutlet var Seller: UILabel!
    
    @IBOutlet var car_info: UILabel!
    
    @IBOutlet var Vin: UILabel!
    
    @IBOutlet var Note: UILabel!
    
    @IBOutlet var newNote: UITextField!
    
    var task = [String: Any]()
    var officerId = Int()
    
    @IBAction func log_out(_ sender: Any) {
        UserDefaults.standard.set(nil, forKey: "Token")
        self.performSegue(withIdentifier: "GoBackToLogin", sender: self)
    }
    
    @IBAction func accpet(_ sender: Any) {
        action(action: "accept", callback: {(state: String) -> (Void) in
            if state == "success"{
                print("success")
                _ = self.navigationController?.popViewController(animated: true)
            }
        })
    }
    
    @IBAction func reject(_ sender: Any) {
        action(action: "reject", callback: {(state: String) -> (Void) in
            if state == "success"{
                print("success")
                _ = self.navigationController?.popViewController(animated: true)
            }
        })
    }
    
    func action(action: String, callback: @escaping (String)->(Void)) {
        Alamofire.request("http://flow.sushithedog.com/src/action.php", method: .post, parameters: [
            "mode": "Officer2Action",
            "id": officerId,
            "taskId": task["id"]!,
            "note": newNote.text!,
            "action": action
            ])
            .responseJSON { response in
                switch response.result.isSuccess {
                case true:
                    if let Message = response.result.value {
                        if Message as! Bool{
                            callback("success")
                        }
                        else {
                            self.action_failed(showError: "Action did not pass")
                            callback("fail")
                        }
                    }
                    break
                case false:
                    self.action_failed(showError: "Internet Connect Error")
                    callback("fail")
                    break
            }
        }
    }
    
    func action_failed(showError: String){
        let alert = UIAlertController(title: "Action Error", message: showError, preferredStyle: UIAlertControllerStyle.alert)
        alert.addAction(UIAlertAction(title: "Try Again", style: UIAlertActionStyle.default, handler: nil))
        self.present(alert, animated: true, completion: nil)
    }
    
       override func viewDidLoad() {
        super.viewDidLoad()
        let id = task["id"] as! String
        ID.text = "ID: " + id
        let seller = task["seller"] as! String
        Seller.text = "Seller: " + seller
        let info = task["car_info"] as! String
        car_info.text = "Car Info: " + info
        let vin = task["vin"] as! String
        Vin.text = "vin: " + vin
        switch task["stage"] as! String{
        case "1":
            if let note = task["stage1Note"] as? String
            {
                Note.text = "Note: " + note
            }
            else
            {
                Note.text = "Note: "
            }
            break
        case "2":
            if let note = task["stage2Note"] as? String
            {
                Note.text = "Note: " + note
            }
            else
            {
                Note.text = "Note: "
            }
            break
        case "3":
            if let note = task["stage3Note"] as? String
            {
                Note.text = "Note: " + note
            }
            else
            {
                Note.text = "Note: "
            }
            break
        default: break
            
        }
        
        
        
        
        
        
        // Do any additional setup after loading the view.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
