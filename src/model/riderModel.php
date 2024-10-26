<?phpnamespace model;include_once '../../config/Dbconnect.php';class riderModel extends \Dbconnect{    public $status = 'ReadyToDeliver';    public $drop = 'Completed';  public function displayListOrder()  {      $query = "SELECT DISTINCT CostumerName, Address, Email,PhoneNumber        FROM orders        WHERE Status = ?";      $stmt = $this->Connect()->prepare($query);      $stmt->bind_param('s',$this->status);      $stmt->execute();      $result = $stmt->get_result();      if ($result->num_rows > 0){          $dataRow = [];          while ($row = $result->fetch_assoc()){              $dataRow[] = $row;          }          return $dataRow;      }      return null;  }  public function displayOrdersDetails($email)  {      $query = "SELECT ProductName,Address,OrderId,quantity,OrderAmount FROM orders WHERE Email = ? AND Status = ?";      $stmt = $this->Connect()->prepare($query);      $stmt->bind_param('ss',$email,$this->status);      $stmt->execute();      $result = $stmt->get_result();      if ($result->num_rows > 0){          $dataRow = [];          while ($row = $result->fetch_assoc()){              $dataRow[] = $row;          }          return $dataRow;      }      return null;  }  public function dropOff($email,$prof)  {      $query = "UPDATE orders SET Status = ? ,proof = ? WHERE Email = ?";      $smt = $this->Connect()->prepare($query);      $smt->bind_param('sss', $this->drop, $prof, $email);      if ($smt->execute()){          echo json_encode(['success' => true, 'message' =>  'orders is successfully drop' ]);      }else{          echo json_encode(['success' => false, 'message' => $smt->error] );      }  }}